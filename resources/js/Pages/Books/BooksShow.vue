<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue"
import { UserIcon } from '@heroicons/vue/20/solid'
import {Link} from "@inertiajs/vue3"
import Card from "@/Components/Card.vue"
import BackButton from "@/Components/BackButton.vue"
defineOptions({ layout: GuestLayout })
const props = defineProps({
    book: Object,
    related: Object
})
const links = [
    {
        name: "Naslovi",
        url: route('books.index')
    },
]
console.log(props.related);
</script>

<template>
    <div class="container mx-auto px-7">
        <div class="overflow-hidden bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                <h3 class="text-2xl  font-medium leading-6 text-gray-900 ">Informacije o naslovu "{{book.title}}"</h3>
                <BackButton />
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Puni naziv</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{book.title}}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Autori</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
                            <ul role="list" class="divide-y divide-gray-200 rounded-md border border-gray-200">
                                <li v-for="author in book.authors" class="flex items-center justify-between py-3 pl-3 pr-4 text-sm">
                                    <Link :href="route('authors.show', author.id)" class="flex w-0 flex-1 items-center">
                                        <UserIcon class="h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
                                        <span class="ml-2 w-0 flex-1 truncate font-medium text-indigo-600 hover:text-indigo-500">{{author.name}}</span>
                                    </Link>
                                </li>
                            </ul>
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Signatura</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{book.signature}}</dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Inventarni broj</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{book.inventory_number}}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Izdavač</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{book.publisher}}</dd>
                    </div>                    
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Mjesto i godina izdavanja</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{book.location_published+", "+book.year_published}}</dd>
                    </div>                    
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Broj jedinica</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">{{book.number_of_units}}</dd>
                    </div>                    
                </dl>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-7 my-4">
        <div class="overflow-hidden bg-white shadow sm:rounded-lg mx-auto">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Ostali naslovi relevantni za naslov "{{book.title}}"</h3>
            </div>
            <div class="border-t border-gray-200 py-3 md:flex justify-center">
                <Card class="my-3" v-for="relevantBook in related" 
                :key="relevantBook.id" 
                :title="relevantBook.title" 
                :description="relevantBook.readableAuthors" 
                :link="route('books.show', relevantBook.id)"/>
            </div>
        </div>
    </div>
    
</template>

<style scoped>

</style>