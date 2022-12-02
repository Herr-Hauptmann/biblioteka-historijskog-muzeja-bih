<template>
  <Navbar :logo_url="logo_url"/>
  <Landing :logo_url="full_logo_url" :background_url="background_photo_url"/>
</template>

<script>
import Navbar from '../Shared/Navbar.vue'
import Landing from './Partials/Landing.vue'

export default {
    name: 'Home',
    components: {Navbar, Landing},
    props: [
      'logo_url', 
      'full_logo_url', 
      'background_photo_url'
    ],
    setup(){

    }
}
</script>

<style>

</style>