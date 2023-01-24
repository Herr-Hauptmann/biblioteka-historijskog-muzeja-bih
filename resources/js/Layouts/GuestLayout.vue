<script setup>
import Navbar from "@/Shared/Navbar.vue";
import Footer from "@/Shared/Footer.vue";

</script>

<template>
  <div class="min-h-screen flex flex-col">
    <Navbar />
    <slot></slot>
    <Footer />
  </div>
</template>