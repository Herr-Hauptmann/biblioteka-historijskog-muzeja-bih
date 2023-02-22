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
    publications: Object,
});

//Search
const placeholder = "Pretraži publikacije"
const path = "publications.index"

let paginationData = computed(()=>{
    let pag = JSON.parse(JSON.stringify(props.publications));
    delete pag.data;
    return pag;
});

//DELETE
let deleteInfo = reactive({
    id: null,
    deleteMessage : 'publikaciju ',
    deleteRoute : 'publications.destroy',
    isOpen : false,
})

function processDelete(publicationTitle, publicationId){
    deleteInfo.id = publicationId;
    deleteInfo.deleteMessage= 'publikaciju "' + publicationTitle + '"';
    deleteInfo.isOpen = true
}

defineOptions({ layout: AuthenticatedLayout })

</script>

<template>
    <Head title="Publikacije" />
    <Content>
        <!-- Layout header -->
        <template v-slot:header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight my-auto">
                    Publikacije
                </h2>
                <Link :href="route('publications.create')">
                    <button
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Kreiraj publikaciju
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
                    <table class="table-fixed md:table-auto w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700">
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
                            <tr v-for="publication in publications.data" :key="publication.id"
                                class="bg-white border-b hover:bg-gray-200">
                                <th scope="row"
                                    class="py-4 px-6 font-medium text-gray-900 md:whitespace-nowrap">
                                    <Link :href="route('publications.show', publication.id)">
                                        {{ publication.title }}
                                    </Link>
                                </th>
                                <td class="py-4 px-6 hidden md:table-cell">
                                    {{ publication.description }}
                                </td>
                                <td class="py-4 px-6 hidden md:table-cell">
                                    {{ publication.created_at }}
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <Link :href="route('publications.edit', publication.id)"
                                        class="font-medium text-blue-600 hover:underline px-2">Uredi</Link>
                                    <a href="#"  @click="processDelete(publication.title, publication.id)"
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