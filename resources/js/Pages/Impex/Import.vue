<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Content from '@/Components/Content.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

//Layout
defineOptions({ layout: AuthenticatedLayout })
</script>

<template>
    <Head title="Import data" />
    <Content>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Učitavanje podataka</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <main class="col-span-10 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form :action="route('books.import')" method="get">      
                            <div class="grid grid-cols-12 gap-2 content-center">
                                <div class="col-span-10">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Učitavanje knjiga</label>
                                    <input name="file_input" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" aria-describedby="file_input_help" id="file_input" type="file">
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">Odaberite excel datoteku.</p>
                                </div>
                                <div class="col-span-2 flex justify-center content-center align-center">
                                    <div class="flex flex-col justify-center content-center align-center">
                                        <button type="submit" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200">Učitaj knjige</button>

                                    </div>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </main>
            </div>
        </div>
    </Content>
</template>

<style scoped>

</style>