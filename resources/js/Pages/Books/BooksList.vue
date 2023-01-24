<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import { computed } from "vue";
import Pagination from "@/Shared/Pagination.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue"
import SearchBar from "@/Components/SearchBar.vue";
import Content from "@/Components/Content.vue"
defineOptions({ layout: GuestLayout })

let props = defineProps({
    filters: Object,
    books: Object
});

//Search
const placeholder = "Pretraži naslove"
const path = "books.index"

let paginationData = computed(() => {
    let pag = JSON.parse(JSON.stringify(props.books));
    delete pag.data;
    return pag;
});

</script>

<template>

    <Head title="Naslovi" />
    <!-- Main content -->
    <main class="pb-12 pt-4 min-h-screen bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-x-auto relative shadow-sm sm:rounded-lg">
                <!-- Search bar -->
                <SearchBar :placeholder="placeholder" :filters="filters" :path="path" />
                <!-- Table -->
                <table class="table-fixed md:table-auto w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="py-3 px-6 max-w-18">
                                Naslov
                            </th>
                            <th scope="col" class="py-3 px-6 hidden md:table-cell">
                                <div class="flex items-center">
                                    Autor
                                    <a href="#"><svg xmlns="http://www.w3.org/2000/svg" class="ml-1 w-3 h-3"
                                            aria-hidden="true" fill="currentColor" viewBox="0 0 320 512">
                                            <path
                                                d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z" />
                                        </svg></a>
                                </div>
                            </th>
                            <th scope="col" class="py-3 px-6 hidden md:table-cell">
                                <div class="flex items-center">
                                    Godina
                                    <a href="#"><svg xmlns="http://www.w3.org/2000/svg" class="ml-1 w-3 h-3"
                                            aria-hidden="true" fill="currentColor" viewBox="0 0 320 512">
                                            <path
                                                d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z" />
                                        </svg></a>
                                </div>
                            </th>
                            <th scope="col" class="py-3 px-6 hidden md:table-cell">
                                <div class="flex items-center">
                                    Inv. broj
                                    <a href="#"><svg xmlns="http://www.w3.org/2000/svg" class="ml-1 w-3 h-3"
                                            aria-hidden="true" fill="currentColor" viewBox="0 0 320 512">
                                            <path
                                                d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z" />
                                        </svg></a>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr v-for="book in books.data" :key="book.id"
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-200">
                            <th scope="row"
                                class="py-4 px-6 font-medium text-gray-900 md:whitespace-nowrap dark:text-white">
                                <Link :href="route('books.show', book.id)">
                                {{ book.title }}
                                </Link>
                            </th>
                            <td class="py-4 px-6 hidden md:table-cell">
                                {{ book.author }}
                            </td>
                            <td class="py-4 px-6 hidden md:table-cell">
                                {{ book.year_published }}
                            </td>
                            <td class="py-4 px-6 hidden md:table-cell">
                                {{ book.inventory_number }}
                            </td>

                        </tr>

                    </tbody>
                </table>
                <Pagination :data="paginationData" />
            </div>
        </div>
    </main>
</template>
