<script setup>
import {Link} from "@inertiajs/vue3"

defineProps({
    title: String, 
    description: String,
    link: String
})
</script>

<template>
        <Link :href="link" class="inline-block mx-3 max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{title}}</h5>
            <p class="font-normal text-gray-700">{{description}}</p>
        </Link>
</template>