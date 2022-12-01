<template>
  <Navbar :logo_url="logo_url"/>
  <Landing />
</template>

<script>
import Navbar from '../Shared/Navbar.vue'
import Landing from './Partials/Landing.vue'

export default {
    name: 'Home',
    components: {Navbar, Landing},
    props: ['logo_url'],
    setup(){

    }
}
</script>

<style>

</style>