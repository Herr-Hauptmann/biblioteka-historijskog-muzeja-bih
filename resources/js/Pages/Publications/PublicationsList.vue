<script setup>
import { Head } from "@inertiajs/vue3"
import Pagination from "@/Shared/Pagination.vue"
import { computed, reactive } from "vue"
import GuestLayout from "@/Layouts/GuestLayout.vue"
import SearchBar from "@/Components/SearchBar.vue"
import ImageCard from "@/Components/ImageCard.vue"
import SearchAlert from '@/Components/SearchAlert.vue'


let props = defineProps({
    filters: Object,
    publications: Object,
    pdf_icon: String,
});

//Search
const placeholder = "Pretraži publikacije"
const path = "publications.list"

let paginationData = computed(() => {
    let pag = JSON.parse(JSON.stringify(props.publications));
    delete pag.data;
    return pag;
});

defineOptions({ layout: GuestLayout })
</script>

<template>
    <Head title="Virtuelna biblioteka" />
    <!-- Main content -->
    <div class="pb-12 pt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-x-auto relative shadow-sm sm:rounded-lg">
                <!-- Search bar -->
                <SearchBar :placeholder="placeholder" :filters="filters" :path="path" />
                <div class="overflow-hidden bg-white shadow sm:rounded-lg mx-auto pb-6">
                    <div v-if="publications.total" class="border-t border-gray-200 py-3 md:flex justify-center">
                        <div class="grid md:grid-cols-2 lg:grid-cols-3 justify-center">
                            <ImageCard class="m-3" v-for="publication in publications.data" :key="publication.id" :title="publication.title"
                                :image="pdf_icon" :description="publication.description"
                                :link="route('publications.show', publication.id)" />
                        </div>
                    </div>
                    <SearchAlert v-else :filter="filters.search"/>
                </div>
                <Pagination v-if="publications.total" :data="paginationData" />
            </div>
        </div>
    </div>
</template>

<style scoped></style>