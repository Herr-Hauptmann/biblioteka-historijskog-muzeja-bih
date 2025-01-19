<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Pagination from "@/Shared/Pagination.vue";
import { computed, reactive } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue"
import SearchBar from "@/Components/SearchBar.vue";
import DeleteModal from "@/Components/DeleteModal.vue";
import Content from "@/Components/Content.vue"

let props = defineProps({
    filters: Object,
    news: Object,
});

//Search
const placeholder = "Pretraži priče iz biblioteke"
const path = "news.index"

let paginationData = computed(() => {
    let pag = JSON.parse(JSON.stringify(props.news));
    delete pag.data;
    return pag;
});

//DELETE
let deleteInfo = reactive({
    id: null,
    deleteMessage: 'priču iz biblioteke s naslovom ',
    deleteRoute: 'news.destroy',
    isOpen: false,
})

function processDelete(newsTitle, newsId) {
    deleteInfo.id = newsId;
    deleteInfo.deleteMessage = 'priču iz biblioteke s naslovom "' + newsTitle + '"';
    deleteInfo.isOpen = true
}

defineOptions({ layout: AuthenticatedLayout })
</script>

<template>
    <Head title="Priče" />
    <Content>
        <!-- Layout header -->
        <template v-slot:header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight my-auto">
                    Priče iz biblioteke
                </h2>
                <Link :href="route('news.create')">
                <button
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Kreiraj priču
                </button>
                </Link>
            </div>
        </template>
        <DeleteModal :deleteInfo="deleteInfo" />

        <!-- Main content -->
        <div class="pb-12 pt-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-x-auto relative shadow-sm sm:rounded-lg">
                    <!-- Search bar -->
                    <SearchBar :placeholder="placeholder" :filters="filters" :path="path" />
                    <!-- Table -->
                    <table class="table-fixed md:table-auto w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                            <tr>
                                <th scope="col" class="py-3 px-6 max-w-18">
                                    Naslov
                                </th>
                                <th scope="col" class="py-3 px-6 hidden md:table-cell">
                                    Opis
                                </th>
                                <th scope="col" class="py-3 px-6 hidden md:table-cell">
                                    Datum objave
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    <span class="sr-only">Uredi</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="article in news.data" :key="article.id"
                                class="bg-white border-b hover:bg-gray-200">
                                <th scope="row" class="py-4 px-6 font-medium text-gray-900 md:whitespace-nowrap">
                                    <a target="_blank" :href="route('news.show', article.id)">
                                        {{ article.title }}
                                    </a>
                                </th>
                                <td class="py-4 px-6 hidden md:table-cell">
                                    {{ article.description }}
                                </td>
                                <td class="py-4 px-6 hidden md:table-cell">
                                    {{ article.created_at }}
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <Link :href="route('news.edit', article.id)"
                                        class="font-medium text-blue-600 hover:underline px-2">Uredi</Link>
                                    <a href="javascript:void(0)" @click="processDelete(article.title, article.id)"
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

<style scoped></style>