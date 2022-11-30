<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['writer', 'title', 'year_published'];

    public function keywords(){
        return $this->hasMany(Keyword::class);
    }
}
