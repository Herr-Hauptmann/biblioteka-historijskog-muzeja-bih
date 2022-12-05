<template>
  <GuestLayout>
    <Landing :background_url="background_photo_url"/>
  </GuestLayout>
</template>

<script setup>
import Landing from './Partials/Landing.vue'
import GuestLayout from '@/Layouts/GuestLayout.vue'

defineProps({
  'background_photo_url' : String
});

</script>

<style>

</style>