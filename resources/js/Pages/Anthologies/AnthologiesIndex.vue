<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Pagination from "@/Shared/Pagination.vue";
import { computed, reactive } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue"
import SearchBar from "@/Components/SearchBar.vue";
import DeleteModal from "@/Components/DeleteModal.vue";
import Content from "@/Components/Content.vue"
import AnthologyBookInfoDisplay from "@/Components/AnthologyBookInfoDisplay.vue"

let props = defineProps({
    filters: Object,
    anthologies: Object,
    bookInfo: {
        type: Object,
        default: null,
    },
});

const placeholder = "Pretraži brojeve zbornika radova Historijskog muzeja BiH"
const path = "anthologies.index"

let paginationData = computed(()=>{
    let pag = JSON.parse(JSON.stringify(props.anthologies));
    delete pag.data;
    return pag;
});

let deleteInfo = reactive({
    id: null,
    deleteMessage : 'broj zbornika ',
    deleteRoute : 'anthologies.destroy',
    isOpen : false,
})

function processDelete(anthologyTitle, anthologyId){
    deleteInfo.id = anthologyId;
    deleteInfo.deleteMessage= 'broj zbornika radova Historijskog muzeja BiH pod naslovom "' + anthologyTitle + '"';
    deleteInfo.isOpen = true
}

defineOptions({ layout: AuthenticatedLayout })

</script>

<template>
    <Head title="Zbornik radova Historijskog muzeja BiH" />
    <Content>
        <template v-slot:header>
            <div class="flex flex-col gap-3 sm:flex-row sm:justify-between sm:items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight my-auto">
                    Zbornik radova Historijskog muzeja BiH
                </h2>
                <div class="flex flex-wrap gap-2 justify-end">
                    <Link :href="route('anthologies.book-info.edit')">
                        <button
                            type="button"
                            class="text-gray-800 bg-white border border-gray-300 hover:bg-gray-50 focus:ring-4 focus:outline-none focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Podaci o zborniku
                        </button>
                    </Link>
                    <Link :href="route('anthologies.create')">
                        <button
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Dodaj broj zbornika
                        </button>
                    </Link>
                </div>
            </div>
        </template>
        <DeleteModal :deleteInfo="deleteInfo"/>

        <div class="pb-12 pt-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <AnthologyBookInfoDisplay v-if="bookInfo" :book-info="bookInfo" />
                <div class="bg-white overflow-x-auto relative shadow-sm sm:rounded-lg">
                    <SearchBar :placeholder="placeholder" :filters="filters" :path="path"/>
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
                            <tr v-for="anthology in anthologies.data" :key="anthology.id"
                                class="bg-white border-b hover:bg-gray-200">
                                <th scope="row"
                                    class="py-4 px-6 font-medium text-gray-900 md:whitespace-nowrap">
                                    <a target="_blank" :href="route('anthologies.show', anthology.id)">
                                        {{ anthology.title }}
                                    </a>
                                </th>
                                <td class="py-4 px-6 hidden md:table-cell">
                                    {{ anthology.description }}
                                </td>
                                <td class="py-4 px-6 hidden md:table-cell">
                                    {{ anthology.created_at }}
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <Link :href="route('anthologies.edit', anthology.id)"
                                        class="font-medium text-blue-600 hover:underline px-2">Uredi</Link>
                                    <a href="javascript:void(0)"  @click="processDelete(anthology.title, anthology.id)"
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
