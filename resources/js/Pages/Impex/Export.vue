<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Content from '@/Components/Content.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';

//Layout
defineOptions({ layout: AuthenticatedLayout })

const downloadBooks = ()=>{
    window.open(route('books.export'))
}
</script>

<template>
    <Head title="Export data" />
    <Content>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Spremanje podataka</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <main class="col-span-10 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <button @click="downloadBooks" class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200" type="button">Sačuvaj knjige</button>
                    </div>
                </main>
            </div>
        </div>
    </Content>
</template>

<style scoped>

</style>