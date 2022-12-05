<template>
    <div class="relative overflow-hidden bg-white">
    <div class="pt-16 pb-80 sm:pt-24 sm:pb-40 lg:pt-16 lg:pb-48">
        <div class="relative mx-auto max-w-7xl px-4 sm:static sm:px-6 lg:px-8">
        <div class="sm:max-w-lg">
            <h1 class="font text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">{{title}}</h1>
            <p class="mt-4 text-xl text-gray-500">{{content}}</p>
        </div>
        <div>
            <div class="mt-10">
            <!-- Decorative image grid -->
            <div aria-hidden="true" class="pointer-events-none lg:absolute lg:inset-y-0 lg:mx-auto lg:w-full lg:max-w-7xl">
                <div class="absolute transform sm:left-1/2 sm:top-0 sm:translate-x-8 lg:left-1/2 lg:top-1/2 lg:-translate-y-1/2 lg:translate-x-8">
                <div class="flex items-center space-x-6 lg:space-x-8">
                    <div class="grid flex-shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8">
                    <div class="h-64 w-44 overflow-hidden rounded-lg sm:opacity-0 lg:opacity-100">
                        <img src="https://tailwindui.com/img/ecommerce-images/home-page-03-hero-image-tile-01.jpg" alt="" class="h-full w-full object-cover object-center">
                    </div>
                    <div class="h-64 w-44 overflow-hidden rounded-lg">
                        <img src="https://tailwindui.com/img/ecommerce-images/home-page-03-hero-image-tile-02.jpg" alt="" class="h-full w-full object-cover object-center">
                    </div>
                    </div>
                    <div class="grid flex-shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8">
                    <div class="h-64 w-44 overflow-hidden rounded-lg">
                        <img src="https://tailwindui.com/img/ecommerce-images/home-page-03-hero-image-tile-03.jpg" alt="" class="h-full w-full object-cover object-center">
                    </div>
                    <div class="h-64 w-44 overflow-hidden rounded-lg">
                        <img src="https://tailwindui.com/img/ecommerce-images/home-page-03-hero-image-tile-04.jpg" alt="" class="h-full w-full object-cover object-center">
                    </div>
                    <div class="h-64 w-44 overflow-hidden rounded-lg">
                        <img src="https://tailwindui.com/img/ecommerce-images/home-page-03-hero-image-tile-05.jpg" alt="" class="h-full w-full object-cover object-center">
                    </div>
                    </div>
                    <div class="grid flex-shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8">
                    <div class="h-64 w-44 overflow-hidden rounded-lg">
                        <img src="https://tailwindui.com/img/ecommerce-images/home-page-03-hero-image-tile-06.jpg" alt="" class="h-full w-full object-cover object-center">
                    </div>
                    <div class="h-64 w-44 overflow-hidden rounded-lg">
                        <img src="https://tailwindui.com/img/ecommerce-images/home-page-03-hero-image-tile-07.jpg" alt="" class="h-full w-full object-cover object-center">
                    </div>
                    </div>
                </div>
                </div>
            </div>

            <a href="#" class="inline-block rounded-md border border-transparent bg-indigo-600 py-3 px-8 text-center font-medium text-white hover:bg-indigo-700">{{button}}</a>
            </div>
        </div>
        </div>
    </div>
    </div>
</template>

<script setup>


let title = "Biblioteka Historijskog muzeja Bosne i Hercegovine";
let content = "Biblioteka Historijskog muzeja BiH, nekadašnjeg Muzeja revolucije BiH, broji preko 20 000 jedinica. Građa se čuva u muzejskoj čitaonici i biblioteci – a jedinice su organizirane prema formatima. Prije 6 godina je započeo proces adaptacije fizičkog prostora: čišćenje, reorganizacija prostora i stvaranje optimalnih uslova za čuvanje muzejske građe. Trenutno je u toku revizija biblioteke.";
let button = "Pretraži muzejsku građu";

</script>

<script>
import GuestLayout from '@/Layouts/GuestLayout.vue'
export default {
   layout: GuestLayout
};
</script>

<style>

</style>