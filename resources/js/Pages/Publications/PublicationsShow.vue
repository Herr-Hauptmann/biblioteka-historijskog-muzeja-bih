<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
defineOptions({ layout: GuestLayout })

const props = defineProps({
    id: String,
})

const link = route('publications.get', props.id);
const googleLink = "https://docs.google.com/gview?url="+link+"&embedded=true";
</script>

<template>
    <div class="lg:container lg:mx-auto mx-0 px-0 bx-0">
        <iframe :src="googleLink" class="pdfDocument w-full h-port" frameborder="0"></iframe>
    </div>
</template>

<style scoped>
.h-port{
    height: 90vh;
}
</style>