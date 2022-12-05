<template>
  <div class="min-h-screen flex flex-col">
    <Navbar />
    <slot></slot>
  </div>
</template>

<script setup>
import Navbar from "@/Shared/Navbar.vue";
</script>