<script setup>
import {Link} from "@inertiajs/inertia-vue3"
</script>

<template>
    <footer class="mt-5 p-4 bg-white rounded-lg shadow md:px-6 md:py-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <div class="flex justify-center pb-3">
                <Link :href="route('home')" class="flex items-center mb-4 sm:mb-0">
                    <img :src="$page.props.images.logoSmall" class="h-8 mr-3" alt="Historijski muzej BiH" />
                    <span class="hidden md:inline self-center text-2xl font-semibold whitespace-nowrap">Biblioteka Historijskog muzeja Bosne i Hercegovine</span>
                </Link>
            </div>
            <ul class="flex flex-wrap justify-between items-center mb-6 text-sm text-gray-500 sm:mb-0">
                <li>
                    <Link :href="route('about')" class="mr-4 hover:underline md:mr-6 ">O biblioteci</Link>
                </li>
                <li>
                    <Link :href="route('books.list')" class="mr-4 hover:underline md:mr-6">Naslovi</Link>
                </li>
                <li>
                    <Link :href="route('faq')" class="mr-4 hover:underline md:mr-6 ">FAQ</Link>
                </li>
                <li>
                    <Link :href="route('contact')" class="hover:underline">Kontakt</Link>
                </li>
            </ul>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto lg:my-8" />
        <span class="block text-sm text-gray-500 sm:text-center">© Historijski muzej Bosne i Hercegovine. Sva prava zadržana.
        </span>
    </footer>
</template>