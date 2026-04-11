<script setup>
import ImageCard from '@/Components/ImageCard.vue'
import AnthologyBookInfoDisplay from '@/Components/AnthologyBookInfoDisplay.vue'
import { Link } from '@inertiajs/vue3'
import { ref } from 'vue'
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from '@headlessui/vue'

const anthologies = ref([])
const infoModalOpen = ref(false)

const load = async () => {
    try {
        const data = await fetch(route('anthologies.landing'))
        if (!data.ok) {
            throw Error('anthologies data not available')
        }
        anthologies.value = await data.json()
    } catch (err) {
        console.log(err.message)
    }
}
load()
</script>

<template>
    <div class="container mx-auto">
        <div class="container mx-auto px-7 my-4">
            <div class="mt-12 mb-5 flex flex-col gap-3 sm:flex-row sm:flex-wrap sm:items-end sm:justify-between">
                <h2 class="text-4xl sm:text-5xl md:text-6xl leading-tight">
                    Zbornik radova Historijskog muzeja BiH
                </h2>
                <button
                    v-if="anthologies.book_info"
                    type="button"
                    class="group shrink-0 inline-flex items-center gap-2.5 rounded-full border border-gray-900/10 bg-white px-5 py-2.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-black/5 transition duration-200 hover:-translate-y-0.5 hover:border-gray-900/20 hover:bg-gray-50 hover:shadow-md focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-600 focus-visible:ring-offset-2 sm:mb-2"
                    :aria-expanded="infoModalOpen"
                    aria-controls="anthology-book-info-dialog"
                    @click="infoModalOpen = true"
                >
                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-gray-900 text-white transition group-hover:bg-blue-700">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                    <span class="text-left leading-tight">
                        <span class="block text-[11px] font-medium uppercase tracking-wider text-gray-500 group-hover:text-gray-600">Zbornik</span>
                        <span class="block">Više informacija</span>
                    </span>
                    <svg class="h-4 w-4 shrink-0 text-gray-400 transition group-hover:translate-x-0.5 group-hover:text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>

            <TransitionRoot appear :show="infoModalOpen" as="template">
                <Dialog id="anthology-book-info-dialog" as="div" class="relative z-50" @close="infoModalOpen = false">
                    <TransitionChild
                        as="template"
                        enter="duration-200 ease-out"
                        enter-from="opacity-0"
                        enter-to="opacity-100"
                        leave="duration-150 ease-in"
                        leave-from="opacity-100"
                        leave-to="opacity-0"
                    >
                        <div class="fixed inset-0 bg-black/40" aria-hidden="true" />
                    </TransitionChild>

                    <div class="fixed inset-0 overflow-y-auto p-4 sm:p-6">
                        <div class="flex min-h-full items-center justify-center">
                            <TransitionChild
                                as="template"
                                enter="duration-200 ease-out"
                                enter-from="opacity-0 scale-95"
                                enter-to="opacity-100 scale-100"
                                leave="duration-150 ease-in"
                                leave-from="opacity-100 scale-100"
                                leave-to="opacity-0 scale-95"
                            >
                                <DialogPanel
                                    class="w-full max-w-2xl transform overflow-hidden rounded-2xl bg-white p-6 text-left shadow-xl transition-all max-h-[85vh] flex flex-col"
                                >
                                    <div class="flex shrink-0 items-start justify-between gap-4 border-b border-gray-100 pb-4 mb-4">
                                        <DialogTitle as="h3" class="text-lg font-semibold text-gray-900 pr-2">
                                            Zbornik radova Historijskog muzeja BiH
                                        </DialogTitle>
                                        <button
                                            type="button"
                                            class="rounded-lg p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            @click="infoModalOpen = false"
                                        >
                                            <span class="sr-only">Zatvori</span>
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="min-h-0 flex-1 overflow-y-auto -mr-1 pr-1">
                                        <AnthologyBookInfoDisplay
                                            v-if="anthologies.book_info"
                                            :book-info="anthologies.book_info"
                                            compact
                                        />
                                    </div>
                                </DialogPanel>
                            </TransitionChild>
                        </div>
                    </div>
                </Dialog>
            </TransitionRoot>

            <div class="overflow-hidden bg-white shadow sm:rounded-lg mx-auto pb-6">
                <div class="border-gray-200 py-3 md:flex justify-center">
                    <ImageCard
                        v-for="article in (anthologies.data || [])"
                        :key="article.id"
                        class="m-3"
                        :title="article.title"
                        :image="anthologies.image_path"
                        :description="article.description"
                        :link="route('anthologies.show', article.id)"
                    />
                </div>
                <Link
                    class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mx-6"
                    :href="route('anthologies.list')"
                >Pregledaj Zbornik radova Historijskog muzeja BiH...</Link>
            </div>
        </div>
    </div>
</template>

<style scoped>
</style>
