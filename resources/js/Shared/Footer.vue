<script setup>
import {Link} from "@inertiajs/inertia-vue3"
</script>

<template>
    <footer class="mt-5 p-4 bg-white rounded-lg shadow md:px-6 md:py-8 dark:bg-gray-900">
        <div class="sm:flex sm:items-center sm:justify-between">
            <Link :href="route('home')" class="flex items-center mb-4 sm:mb-0">
                <img :src="$page.props.images.logoSmall" class="h-8 mr-3" alt="Historijski muzej BiH" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Biblioteka Historijskog muzeja Bosne i Hercegovine</span>
            </Link>
            <ul class="flex flex-wrap items-center mb-6 text-sm text-gray-500 sm:mb-0 dark:text-gray-400">
                <li>
                    <Link :href="route('about')" class="mr-4 hover:underline md:mr-6 ">O biblioteci</Link>
                </li>
                <li>
                    <Link :href="route('books.list')" class="mr-4 hover:underline md:mr-6">Naslovi</Link>
                </li>
                <li>
                    <Link :href="route('home')" class="mr-4 hover:underline md:mr-6 ">Licensing</Link>
                </li>
                <li>
                    <Link :href="route('home')" class="hover:underline">Contact</Link>
                </li>
            </ul>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© Historijski muzej Bosne i Hercegovine. Sva prava zadržana.
        </span>
    </footer>
</template>