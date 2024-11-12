<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Pagination from "@/Shared/Pagination.vue";
import { computed, reactive } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue"
import SearchBar from "@/Components/SearchBar.vue";
import Content from "@/Components/Content.vue";
import DeleteModal from "@/Components/DeleteModal.vue";

//DELETE
let deleteInfo = reactive({
    id: null,
    deleteMessage : 'autora ',
    deleteRoute : 'authors.destroy',
    isOpen : false,
})

function setIsOpen(value) {
    deleteInfo.isOpen = value
}

function processDelete(authorName, authorId){
    deleteInfo.id = authorId;
    deleteInfo.deleteMessage= 'autora "' + authorName + '"';
    setIsOpen(true);
}


//PROPS
let props = defineProps({
    filters: Object,
    authors: Object
});

//SEARCH
const placeholder = "Pretraži autore"
const path = 'authors.index'


//PAGINATION
let paginationData = computed(() => {
    let pag = JSON.parse(JSON.stringify(props.authors));
    delete pag.data;
    return pag;
});

defineOptions({ layout: AuthenticatedLayout })
</script>

<template>
    <Head title="Autori" />
    <Content>
        <!-- Layout header -->
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight my-auto">
                    Autori
                </h2>
                <Link :href="route('authors.create')">
                <button
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Dodaj autora
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
                    <SearchBar :placeholder="placeholder" :filters="filters" :path="path" />
                    <!-- Table -->
                    <table class="table-fixed md:table-auto w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="py-3 px-6 hidden md:table-cell">
                                    <div class="flex items-center">
                                        Ime autora
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
                            <tr v-for="author in authors.data" :key="author.id"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-200">
                                <th scope="row"
                                    class="py-4 px-6 font-medium text-gray-900 md:whitespace-nowrap dark:text-white">
                                    <Link :href="route('authors.books', author.id)">
                                        {{ author.name }}
                                    </Link>
                                </th>
                                <td class="py-4 px-6 text-right">
                                    <Link :href="route('authors.edit', author.id)"
                                        class="font-medium text-blue-600 hover:underline px-2">Uredi</Link>
                                    <a @click="processDelete(author.name, author.id)" href="#"
                                        class="font-medium text-red-600 hover:underline px-2">Izbriši</a>
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
