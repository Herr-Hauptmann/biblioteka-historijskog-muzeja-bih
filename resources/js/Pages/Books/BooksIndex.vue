<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import Pagination from "@/Shared/Pagination.vue";
import { computed, reactive } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue"
import SearchBar from "@/Components/SearchBar.vue";
import DeleteModal from "@/Components/DeleteModal.vue";
import Content from "@/Components/Content.vue"

let props = defineProps({
    filters: Object,
    books: Object,
    what: String
});

//Search
const placeholder = "Pretraži knjige"
const path = "books.index"

let paginationData = computed(()=>{
    let pag = JSON.parse(JSON.stringify(props.books));
    delete pag.data;
    return pag;
});

//DELETE
let deleteInfo = reactive({
    id: null,
    deleteMessage : 'knjigu ',
    deleteRoute : 'books.destroy',
    isOpen : false,
})

function processDelete(bookTitle, bookId){
    deleteInfo.id = bookId;
    deleteInfo.deleteMessage= 'knjigu "' + bookTitle + '"';
    console.log(bookTitle);
    deleteInfo.isOpen = true
}

defineOptions({ layout: AuthenticatedLayout })

</script>

<template>
    <Head title="Knjige" />
    <Content>
        <!-- Layout header -->
        <template v-slot:header>
            <div class="flex justify-between">
                <h2 v-if="what" class="font-semibold text-xl text-gray-800 leading-tight my-auto">
                    Knjige {{ what }}
                </h2>
                <h2 v-else class="font-semibold text-xl text-gray-800 leading-tight my-auto">
                    Knjige
                </h2>
                <Link :href="route('books.create')">
                <button
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Dodaj knjigu
                </button>
                </Link>
            </div>
        </template>
        <DeleteModal :deleteInfo="deleteInfo"/>

        <!-- Main content -->
        <div class="pb-12 pt-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-x-auto relative shadow-sm sm:rounded-lg">
                    <!-- Search bar -->
                    <SearchBar v-if="!what" :placeholder="placeholder" :filters="filters" :path="path"/>
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
                                        Signatura
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
                                <th scope="col" class="py-3 px-6">
                                    <span class="sr-only">Uredi</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="book in books.data" :key="book.id"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-200">
                                <th scope="row"
                                    class="py-4 px-6 font-medium text-gray-900 max-w-56">
                                    <Link :href="route('books.show', book.id)">
                                        {{ book.title }}
                                    </Link>
                                </th>
                                <td class="py-4 px-6 hidden md:table-cell">
                                    {{ book.author }}
                                </td>
                                <td class="py-4 px-6 hidden md:table-cell">
                                    {{ book.signature }}
                                </td>
                                <td class="py-4 px-6 hidden md:table-cell">
                                    {{ book.inventory_number }}
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <Link :href="route('books.edit', book.id)"
                                        class="font-medium text-blue-600 hover:underline px-2">Uredi</Link>
                                    <a href="#"  @click="processDelete(book.title, book.id)"
                                        class="font-medium text-red-600 hover:underline px-2">Obriši
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <Pagination :data="paginationData" />
                </div>
            </div>
        </div>
    </Content>
</template>
