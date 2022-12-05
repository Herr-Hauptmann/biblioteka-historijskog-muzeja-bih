<template>
    <Landing :background_url="background_photo_url"/>
</template>

<script setup>
import Landing from './Partials/Landing.vue'

defineProps({
  'background_photo_url' : String
});

</script>

<script>
import GuestLayout from '@/Layouts/GuestLayout.vue'
export default {
   layout: GuestLayout
};
</script>

<style>

</style>