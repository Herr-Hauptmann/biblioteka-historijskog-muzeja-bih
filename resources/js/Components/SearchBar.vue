<script setup>
import { ref, watch, computed } from "vue";
import debounce from 'lodash/debounce';
import { router } from '@inertiajs/vue3';

let props = defineProps({
    placeholder: String,
    filters: Object,
    path: String
})
let search = ref(props.filters.search);

watch(search, debounce (function (value){
    router.get(route(props.path), {
        search: value
    }, {
        preserveState: true,
        replace: true
    });
}, 250));

</script>

<template>
    <div class="p-2 md:p-4 bg-white">
        <label for="table-search" class="sr-only">Pretraga</label>
        <div class="relative mt-1">
            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500" aria-hidden="true"
                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            <input type="text" id="table-search"
                class="block p-2 pl-10 w-60 md:w-80 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                v-model="search" :placeholder="placeholder"/>
        </div>
    </div>
</template>