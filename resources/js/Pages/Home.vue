<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import { Head } from '@inertiajs/vue3';
import Landing from './Partials/Landing.vue'
import News from './Partials/News.vue'
import Publications from './Partials/Publications.vue'
import Contact from './Partials/Contact.vue'

defineOptions({ layout: GuestLayout })
defineProps({
  'background_photo_url' : String
})

</script>

<template>
  <Head title="Naslovna" />
  <Landing :background_url="background_photo_url"/>
  <News />
  <Publications />
  <Contact />
</template>



<style>

</style>