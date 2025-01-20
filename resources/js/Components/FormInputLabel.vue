<template>
    <label :for='what' class="block mb-2 text-sm font-medium text-gray-900">{{msg}}</label>
</template>

<script setup>
defineProps({
    what: String,
    msg: String
})
</script>