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

<style>
::-webkit-scrollbar-track
{
	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
	border-radius: 10px;
	background-color: #F5F5F5;
}

::-webkit-scrollbar
{
	width: 8px;
	background-color: #F5F5F5;
}

::-webkit-scrollbar-thumb
{
	border-radius: 10px;
	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
	background-color: #555;
}

.grecaptcha-badge { 
    visibility: hidden;
}
</style>