<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('library:move-anthologies-publications {--direction=swap : swap|anthology-to-publication|publication-to-anthology} {--files : Copy files to destination folders and update file_path}', function () {
    $direction = (string) $this->option('direction');
    $copyFiles = (bool) $this->option('files');

    $validDirections = ['swap', 'anthology-to-publication', 'publication-to-anthology'];
    if (! in_array($direction, $validDirections, true)) {
        $this->error('Invalid --direction value. Allowed: swap, anthology-to-publication, publication-to-anthology');

        return 1;
    }

    $anthologies = DB::table('anthologies')->get();
    $publications = DB::table('publications')->get();

    $this->info('Anthologies: '.$anthologies->count());
    $this->info('Publications: '.$publications->count());
    $this->line('Mode: '.$direction);
    $this->line('File handling: '.($copyFiles ? 'enabled' : 'disabled'));

    if (! $this->confirm('Continue with data move? This replaces destination table content.')) {
        $this->warn('Cancelled.');

        return 0;
    }

    $filesToDeleteAfterSuccess = [];

    $buildRows = function ($rows, string $targetFolder) use ($copyFiles, &$filesToDeleteAfterSuccess) {
        return $rows->map(function ($row) use ($targetFolder, $copyFiles, &$filesToDeleteAfterSuccess) {
            $targetPath = $row->file_path;

            if ($copyFiles && ! empty($row->file_path)) {
                $sourcePath = (string) $row->file_path;

                if (Storage::exists($sourcePath)) {
                    $filename = basename($sourcePath);
                    $targetPath = $targetFolder.'/'.$filename;

                    while (Storage::exists($targetPath)) {
                        $targetPath = $targetFolder.'/'.Str::beforeLast($filename, '.')
                            .'-'.Str::random(6).'.'
                            .Str::afterLast($filename, '.');
                    }

                    if (Storage::copy($sourcePath, $targetPath)) {
                        $filesToDeleteAfterSuccess[] = $sourcePath;
                    } else {
                        $targetPath = $sourcePath;
                    }
                }
            }

            return [
                'title' => $row->title,
                'description' => $row->description,
                'file_path' => $targetPath,
                'created_at' => $row->created_at ?? now(),
                'updated_at' => $row->updated_at ?? now(),
            ];
        })->all();
    };

    try {
        DB::transaction(function () use ($direction, $anthologies, $publications, $buildRows) {
            if ($direction === 'swap') {
                $publicationsRows = $buildRows($anthologies, 'publications');
                $anthologiesRows = $buildRows($publications, 'anthologies');

                DB::table('publications')->delete();
                DB::table('anthologies')->delete();

                if (! empty($publicationsRows)) {
                    DB::table('publications')->insert($publicationsRows);
                }

                if (! empty($anthologiesRows)) {
                    DB::table('anthologies')->insert($anthologiesRows);
                }

                return;
            }

            if ($direction === 'anthology-to-publication') {
                $publicationsRows = $buildRows($anthologies, 'publications');

                DB::table('publications')->delete();
                DB::table('anthologies')->delete();

                if (! empty($publicationsRows)) {
                    DB::table('publications')->insert($publicationsRows);
                }

                return;
            }

            $anthologiesRows = $buildRows($publications, 'anthologies');

            DB::table('anthologies')->delete();
            DB::table('publications')->delete();

            if (! empty($anthologiesRows)) {
                DB::table('anthologies')->insert($anthologiesRows);
            }
        });

        foreach (array_unique($filesToDeleteAfterSuccess) as $path) {
            Storage::delete($path);
        }
    } catch (\Throwable $e) {
        $this->error('Failed: '.$e->getMessage());

        return 1;
    }

    $this->info('Done.');

    return 0;
})->purpose('Move/swap records between anthologies and publications, with optional file migration.');
