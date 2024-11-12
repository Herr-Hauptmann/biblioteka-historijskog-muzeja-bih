<script setup>
import {Link} from "@inertiajs/vue3"

defineProps({
    title: String, 
    description: String,
    link: String,
    image: String
})
</script>

<template>
    <Link :href="link" class="max-w-sm bg-white rounded-lg shadow">
            <img class="rounded-t-lg" :src="image" alt="" />
        <div class="p-5">
            <div>
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{title}}</h5>
            </div>
            <p class="mb-3 font-normal text-gray-700">{{description}}</p>
        </div>
    </Link>
</template>