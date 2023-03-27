<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
defineOptions({ layout: GuestLayout });

let props = defineProps({
    news: Object,
    image: String,
});

</script>

<template>
    <div class="container mx-auto">
        <div class="grid grid-cols-3">
            <div>
                <button class="block">Facebook</button>
                <button class="block">Instagram</button>
            </div>
        </div>
        <div class="grid-span-6">
            <img :src="image" alt="Slika">
        </div>
    </div>

</template>

<style>

</style>