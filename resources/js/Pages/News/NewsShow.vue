<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
defineOptions({ layout: GuestLayout });

let props = defineProps({
    news: Object,
});

</script>

<template>
    <div class="container px-3">
        Ovo je vijest
        <h1>{{news.title}}</h1>
        <div v-html="news.article"></div>
    </div>

</template>

<style>

</style>