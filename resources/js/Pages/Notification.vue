<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import {Link} from "@inertiajs/inertia-vue3"
defineOptions({ layout: GuestLayout })

defineProps({
    title: String,
    description: String,
})

</script>

<template>
    <main class="grid min-h-visina place-items-center bg-white px-6 py-24 sm:py-32 lg:px-8">
        <div class="text-center">
          <h1 class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">{{title}}</h1>
          <p class="mt-6 text-base leading-7 text-gray-600">{{description}}</p>
          <div class="mt-10 flex items-center justify-center gap-x-6">
            <Link :href="route('home')" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Naslovna stranica</Link>
            <Link :href="route('contact')" class="text-sm font-semibold text-gray-900">Kontaktirajte nas <span aria-hidden="true">&rarr;</span></Link>
          </div>
        </div>
      </main>
</template>

<style>
.min-h-visina{
  min-height: 75vh;
}
</style>