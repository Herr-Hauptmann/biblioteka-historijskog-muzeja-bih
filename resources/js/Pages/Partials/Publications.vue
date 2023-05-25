<script setup>

</script>

<template>
    <div class="container mx-auto">
        <div class="container mx-auto px-7 my-4">
            <h2 class="text-6xl mt-12 mb-5">Virtuelna biblioteka</h2>
            <div class="overflow-hidden bg-white shadow sm:rounded-lg mx-auto pb-6">
                <div class="border-gray-200 py-3 md:flex justify-center">
                    
                </div>
                <Link class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mx-6" :href="route('news.list')">Pregledaj sve priče...</Link>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>