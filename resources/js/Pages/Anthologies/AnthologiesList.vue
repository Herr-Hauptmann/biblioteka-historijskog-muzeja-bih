<script setup>
import { Head, Link } from '@inertiajs/vue3'
import Pagination from '@/Shared/Pagination.vue'
import { computed } from 'vue'
import GuestLayout from '@/Layouts/GuestLayout.vue'
import SearchBar from '@/Components/SearchBar.vue'
import SearchAlert from '@/Components/SearchAlert.vue'
import AnthologyBookInfoDisplay from '@/Components/AnthologyBookInfoDisplay.vue'

const props = defineProps({
    filters: Object,
    anthologies: Object,
    pdf_icon: String,
    bookInfo: {
        type: Object,
        default: null,
    },
})

const placeholder = 'Pretraži brojeve zbornika radova Historijskog muzeja BiH'
const path = 'anthologies.list'

const paginationData = computed(() => {
    const pag = JSON.parse(JSON.stringify(props.anthologies))
    delete pag.data
    return pag
})

defineOptions({ layout: GuestLayout })
</script>

<template>
    <Head title="Zbornik radova Historijskog muzeja BiH" />
    <div class="min-h-screen bg-gradient-to-b from-slate-100 via-white to-slate-50 pb-20 pt-8 sm:pt-14">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <header class="mb-10 max-w-3xl">
                <p class="text-xs font-semibold uppercase tracking-[0.22em] text-slate-500">
                    Historijski muzej Bosne i Hercegovine
                </p>
                <h1 class="mt-3 text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl lg:text-[2.5rem] lg:leading-tight">
                    Zbornik radova Historijskog muzeja BiH
                </h1>
                <p class="mt-4 text-base leading-relaxed text-slate-600">
                    Digitalne sekcije zbornika u PDF formatu. Koristite pretragu ili otvorite željeni broj.
                </p>
            </header>

            <section
                v-if="bookInfo"
                class="mb-10 overflow-hidden rounded-2xl bg-white shadow-lg shadow-slate-900/5 ring-1 ring-slate-900/[0.06]"
            >
                <div class="border-b border-slate-100 bg-gradient-to-r from-slate-50 via-white to-slate-50/80 px-6 py-4 sm:px-8 sm:py-5">
                    <div class="flex flex-wrap items-end justify-between gap-2">
                        <div>
                            <h2 class="text-xs font-bold uppercase tracking-widest text-slate-500">
                                Bibliografski i urednički podaci
                            </h2>
                            <p class="mt-1 max-w-xl text-sm text-slate-600">
                                ISSN, izdavač, kontakt i uredništvo zbornika na jednom mjestu.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-6 sm:px-8 sm:py-8">
                    <AnthologyBookInfoDisplay variant="inset" :book-info="bookInfo" />
                </div>
            </section>

            <section class="overflow-hidden rounded-2xl bg-white shadow-lg shadow-slate-900/5 ring-1 ring-slate-900/[0.06]">
                <div class="border-b border-slate-100 bg-slate-50/90 px-4 py-5 sm:px-6">
                    <div class="flex flex-col gap-1 sm:flex-row sm:items-end sm:justify-between">
                        <div>
                            <h2 class="text-sm font-semibold text-slate-900">Pretraga sekcija</h2>
                            <p class="mt-0.5 text-xs text-slate-500">Filtriranje po naslovu ili opisu</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <SearchBar :placeholder="placeholder" :filters="filters" :path="path" />
                    </div>
                </div>

                <div class="px-4 pb-2 pt-4 sm:px-6 sm:pt-6">
                    <div
                        v-if="anthologies.total"
                        class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3"
                    >
                        <Link
                            v-for="anthology in anthologies.data"
                            :key="anthology.id"
                            :href="route('anthologies.show', anthology.id)"
                            class="group flex flex-col overflow-hidden rounded-2xl border border-slate-200/90 bg-white shadow-sm ring-1 ring-slate-900/[0.03] transition duration-300 ease-out hover:-translate-y-1 hover:border-slate-300 hover:shadow-xl hover:shadow-slate-900/10 hover:ring-slate-900/[0.08] focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-600 focus-visible:ring-offset-2"
                        >
                            <div class="relative aspect-[5/3] overflow-hidden bg-gradient-to-br from-slate-200 via-slate-100 to-slate-300">
                                <img
                                    :src="anthology.cover_image || pdf_icon"
                                    alt=""
                                    class="h-full w-full object-cover object-center opacity-95 transition duration-500 ease-out group-hover:scale-[1.04] group-hover:opacity-100"
                                >
                                <div
                                    class="pointer-events-none absolute inset-0 bg-gradient-to-t from-slate-900/55 via-slate-900/10 to-transparent opacity-90 transition group-hover:from-slate-900/65"
                                />
                                <div class="absolute bottom-3 left-3 right-3 flex items-end justify-between gap-2">
                                    <span
                                        class="inline-flex items-center rounded-full bg-white/95 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-slate-800 shadow-sm ring-1 ring-black/5 backdrop-blur-sm"
                                    >PDF</span>
                                    <span
                                        class="text-[11px] font-medium text-white/95 drop-shadow-sm"
                                    >{{ anthology.created_at }}</span>
                                </div>
                            </div>
                            <div class="flex flex-1 flex-col p-5 sm:p-6">
                                <h3
                                    class="text-lg font-bold leading-snug text-slate-900 transition group-hover:text-blue-900"
                                >
                                    {{ anthology.title }}
                                </h3>
                                <p class="mt-2 flex-1 text-sm leading-relaxed text-slate-600 line-clamp-3">
                                    {{ anthology.description }}
                                </p>
                                <span
                                    class="mt-5 inline-flex items-center gap-1.5 text-sm font-semibold text-blue-700"
                                >
                                    Otvori sekciju
                                    <svg
                                        class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-0.5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        aria-hidden="true"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </span>
                            </div>
                        </Link>
                    </div>
                    <div
                        v-else
                        class="mx-auto max-w-lg py-10 sm:py-14"
                    >
                        <div class="rounded-2xl border border-dashed border-slate-200 bg-slate-50/80 px-4 py-8 text-center sm:px-8">
                            <SearchAlert :filter="filters.search" />
                        </div>
                    </div>
                </div>

                <div
                    v-if="anthologies.total"
                    class="border-t border-slate-100 bg-slate-50/60 px-2 py-5 sm:px-4"
                >
                    <Pagination :data="paginationData" />
                </div>
            </section>
        </div>
    </div>
</template>

<style scoped>
</style>
