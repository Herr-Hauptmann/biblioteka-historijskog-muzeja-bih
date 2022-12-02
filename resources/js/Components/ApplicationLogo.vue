<template>
    <img :src="logo_url" alt="Historijski muzej Bosne i Hercegovine">
</template>

<script setup>
defineProps({
    logo_url: String,
});
</script>
