<script setup>
import { ref, computed, watch } from "vue"
import { useForm } from "@inertiajs/vue3"
const mobileMenuOpen = ref(false)

const props = defineProps({
  background_url: String
})

const background = computed(() => {
  if (screen.width > 640)
    return "url(" + props.background_url + ")";
  return "";
})

let form = useForm({
  search: "",
})

const submit = () => {
  form.get(route("books.search"));
}

</script>

<template>
  <div class="flex-1">
    <div class="isolate background z-0" :style="{ 'background-image': background }">
      <main>
        <div class="relative px-6 lg:px-8">
          <div class="mx-auto max-w-4xl pt-10 pb-32 sm:pt-5 sm:pb-40">
            <div class="md:pt-16">
              <div>
                <div class="flex gap-x-4 sm:justify-center">
                  <img :src="$page.props.images.logo" alt="Historijski Muzej BiH" class="h-96 w-auto sm:h-96 img-bg" />
                </div>
                <h1 class="
                    text-4xl
                    font-bold
                    tracking-tight
                    sm:text-center sm:text-6xl
                    sr-only
                  ">
                  Biblioteka Historijskog muzeja Bosne i Hercegovine
                </h1>
                <div class="mt-8 flex gap-x-4 sm:justify-center">
                  <form class="flex items-center w-7/12 min-w-full" @submit.prevent="submit">
                    <label for="simple-search" class="sr-only">Pretraži biblioteku...</label>
                    <div class="relative w-full">
                      <div class="
                          absolute
                          inset-y-0
                          left-0
                          flex
                          items-center
                          pl-3
                          pointer-events-none
                        ">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
                          xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                        </svg>
                      </div>
                      <input v-model="form.search" name="search" type="text" id="simple-search" class="
                          bg-gray-50
                          border border-gray-300
                          text-gray-900 text-sm
                          rounded-lg
                          focus:ring-blue-500 focus:border-blue-500
                          block
                          w-full
                          pl-10
                          p-2.5
                        " placeholder="Pretraži biblioteku" required />
                    </div>
                    <button type="submit" class="
                        p-2.5
                        ml-2
                        text-sm
                        font-medium
                        text-white
                        bg-blue-700
                        rounded-lg
                        border border-blue-700
                        hover:bg-blue-800
                        focus:ring-4 focus:outline-none focus:ring-blue-300
                      ">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                      </svg>
                      <span class="sr-only">Pretraži biblioteku</span>
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</template>

<style scoped>
@media (min-width: 640px) {
  .img-bg {
    background-color: rgb(255, 255, 255, 0.85);
    border-radius: 200px;
    -moz-user-select: none;
    -webkit-user-select: none;
    -webkit-user-drag: none;
    user-select: none;
  }

  .background {
    background-size: 100%;
  }
}

@media (max-width: 639px) {
  .background {
    background-image: none !important;
  }
}
</style>