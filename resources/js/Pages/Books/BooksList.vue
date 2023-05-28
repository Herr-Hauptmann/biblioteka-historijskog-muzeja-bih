<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import { computed } from "vue";
import Pagination from "@/Shared/Pagination.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue"
import SearchBar from "@/Components/SearchBar.vue";
import BackButton from "@/Components/BackButton.vue"
import SearchAlert from '@/Components/SearchAlert.vue'

defineOptions({ layout: GuestLayout })

let props = defineProps({
    filters: Object,
    books: Object,
    path: String,
    what: String
});

//Search
const placeholder = "Pretraži naslove"

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
            <div class="bg-white overflow-x-auto relative shadow-sm sm:rounded-lg m-1">
                <!-- Search bar -->
                <div class="py-1 md:py-5 sm:px-6 flex justify-between items-center">
                    <SearchBar v-if="!what" :placeholder="placeholder" :filters="filters" :path="path" />
                    <BackButton />
                </div>

                <!-- Table -->
                <div v-if="books.total">
                    <table class="table-fixed md:table-auto text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3 px-6 max-w-18">
                                    Naslov
                                </th>
                                <th scope="col" class="py-3 px-6 hidden md:table-cell">
                                    <div class="flex items-center">
                                        Autor
                                    </div>
                                </th>
                                <th scope="col" class="py-3 px-6 hidden md:table-cell">
                                    <div class="flex items-center">
                                        Izdavač
                                    </div>
                                </th>
                                <th scope="col" class="py-3 px-6 hidden md:table-cell">
                                    <div class="flex items-center">
                                        Mjesto izdavanja
                                    </div>
                                </th>
                                <th>
                                    <div class="flex items-center text-center">
                                        Godina izdavanja
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
                                    {{ book.publisher }}
                                </td>
                                <td class="py-4 px-6 hidden md:table-cell">
                                    {{ book.location_published }}
                                </td>
                                <td class="py-4 px-6 text-center">
                                    {{ book.year_published }}
                                </td>

                            </tr>

                        </tbody>
                    </table>
                    <Pagination :data="paginationData" />
                </div>
                <SearchAlert v-else :filter="filters.search"/>

        </div>
    </div>
</main></template>
