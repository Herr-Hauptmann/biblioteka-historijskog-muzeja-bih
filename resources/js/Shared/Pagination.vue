<script setup>
import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/20/solid';
import {Link} from '@inertiajs/vue3';
defineProps({
  data: Object,
});
</script>

<template>
  <nav class="flex justify-between items-center p-4" aria-label="Table navigation">
    <!-- Just for phones -->
    <div class="flex flex-1 justify-between sm:hidden">
      <Component :is="(data.links[0].url==null)? 'span' : Link" :href="data.links[0].url" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Prethodna</Component>
      <p class="text-sm text-gray-700 pt-2">{{data.current_page}}</p>
      <Component :is="(data.links[data.links.length-1].url) ? Link : 'span'" :href="data.links[data.links.length-1].url" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Sljedeća</Component>
    </div>
    <!-- Doesn't show on phones -->
    <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
      <div>
        <p class="text-sm text-gray-700">
          Prikazuje se od
          <span class="font-medium">{{data.from}}</span>
          do
          <span class="font-medium">{{data.to}}</span>
          od
          {{ ' ' }}
          <span class="font-medium">{{data.total}}</span>
          {{ ' ' }}
          rezultata
        </p>
      </div>
      <div>
        <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
          <Component :is='(data.links[0].url==null)? "span" : Link' :href="data.links[0].url"  class="relative inline-flex items-center rounded-l-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">
            <span class="sr-only">Previous</span>
            <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />
          </Component>
          <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
          <div v-for="link in data.links" :key="link.label">
              <Link v-if="(link.label!='Prethodna' && link.label !='Sljedeća')" :href="link.url" class="relative inline-flex items-center border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20" :class="{'z-10 bg-indigo-50 border-indigo-500 text-indigo-600' : link.active}">{{link.label}}</Link>
          </div>
          <Component :is="(data.links[data.links.length-1].url) ? Link : 'span'" :href="data.links[data.links.length-1].url" class="relative inline-flex items-center rounded-r-md border border-gray-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20">
            <span class="sr-only">Next</span>
            <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
          </Component>
        </nav>
      </div>
    </div>
</nav>
</template>