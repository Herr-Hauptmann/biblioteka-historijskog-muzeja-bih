<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import NewsCard from "@/Components/NewsCard.vue"
import { Head } from "@inertiajs/inertia-vue3";
defineOptions({ layout: GuestLayout });

let props = defineProps({
    news: Object,
    image: String,
    latest: Object,
});

</script>

<template>
    <Head :title="news?.title" />
    <div class="container mx-auto px-3">
        <img class="mt-3 mx-auto" :src="image" alt="Slika">
        <h1 class=" my-12 text-4xl font-bold tracking-tight text-center sm:text-6xl">{{news.title}}</h1>
        <div class="grid md:grid-cols-6">
            <div></div>
            <main v-html="news.article" class="clanak my-12 col-span-4"></main>
            <div></div>
        </div>
        <aside>
            <div class="container mx-auto px-7 my-4">
                <div class="overflow-hidden bg-white shadow sm:rounded-lg mx-auto">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Najnovije priče iz biblioteke</h3>
                    </div>
                    <div class="border-t border-gray-200 py-3 md:flex justify-center">
                        <NewsCard class="m-3" v-for="article in latest" 
                        :key="article.id" 
                        :title="article.title" 
                        :image="article.image_path"
                        :description="article.description" 
                        :link="route('news.show', article.id)"/>
                    </div>
                </div>
            </div>
        </aside>
    </div>

</template>

<style scoped>
 
</style>