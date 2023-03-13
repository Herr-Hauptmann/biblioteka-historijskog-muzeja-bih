<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import { Head } from '@inertiajs/inertia-vue3';
import Landing from './Partials/Landing.vue'

defineOptions({ layout: GuestLayout })
defineProps({
  'background_photo_url' : String
})

</script>

<template>
  <Head title="Naslovna" />
  <Landing :background_url="background_photo_url"/>
</template>



<style>

</style>