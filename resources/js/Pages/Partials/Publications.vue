<script setup>
import ImageCard from "@/Components/ImageCard.vue"
import {Link} from "@inertiajs/vue3"
import {ref} from 'vue'

const publications = ref([]);
const load = async() =>{
  try{
    let data = await fetch(route("publications.landing"))
    if (!data.ok){
      throw Error('publications data not available')
    }
    publications.value = await data.json()
  }
  catch(err){
    console.log(err.message)
  }
}
load()
</script>

<template>
    <div class="container mx-auto">
        <div class="container mx-auto px-7 my-4">
            <h2 class="text-6xl mt-12 mb-5">Zbornik radova HMBiH</h2>
            <div class="overflow-hidden bg-white shadow sm:rounded-lg mx-auto pb-6">
                <div class="border-gray-200 py-3 md:flex justify-center">
                    <ImageCard class="m-3" v-for="article in publications.data" :key="article.id" :title="article.title" :image="publications.image_path"
                    :description="article.description" :link="route('publications.show', article.id)" />
                </div>
                <Link class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mx-6" :href="route('publications.list')">Pregledaj sve publikacije...</Link>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>