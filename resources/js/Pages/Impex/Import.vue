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
                        Učitaj dete mu jebem
                    </div>
                </main>
            </div>
        </div>
    </Content>
</template>

<style scoped>

</style>