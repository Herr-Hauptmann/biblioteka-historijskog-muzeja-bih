<script setup>
import { computed } from 'vue'

const props = defineProps({
    bookInfo: {
        type: Object,
        default: null,
    },
    compact: {
        type: Boolean,
        default: false,
    },
    /** 'default' = full panel; 'inset' = nested inside another card */
    variant: {
        type: String,
        default: 'default',
        validator: (v) => ['default', 'inset'].includes(v),
    },
})

const editorialLines = computed(() => {
    if (!props.bookInfo?.editorial_reviews) {
        return []
    }
    return props.bookInfo.editorial_reviews
        .split('\n')
        .map((l) => l.trim())
        .filter(Boolean)
})

const websiteHref = computed(() => {
    const w = props.bookInfo?.publisher_website?.trim()
    if (!w) {
        return null
    }
    if (w.startsWith('http://') || w.startsWith('https://')) {
        return w
    }
    return 'https://' + w.replace(/^\/+/, '')
})

const panelClass = computed(() => {
    if (props.variant === 'inset') {
        return 'rounded-xl bg-gradient-to-br from-slate-50/95 via-white to-slate-50/80 text-slate-800 text-sm ring-1 ring-slate-200/60'
    }
    return 'rounded-2xl border border-slate-200/80 bg-gradient-to-br from-white via-slate-50/40 to-slate-100/30 text-slate-800 text-sm shadow-sm ring-1 ring-slate-900/[0.04]'
})

const innerPad = computed(() => (props.compact ? 'p-4 sm:p-5' : 'p-5 sm:p-7 md:p-8'))
</script>

<template>
    <div v-if="bookInfo" :class="panelClass">
        <div :class="innerPad">
            <div
                v-if="bookInfo.issn"
                class="mb-6 flex flex-wrap items-center gap-3"
            >
                <span
                    class="inline-flex items-center rounded-lg bg-slate-900 px-3 py-1.5 font-mono text-xs font-semibold tracking-wide text-white shadow-sm"
                >ISSN {{ bookInfo.issn }}</span>
                <span class="text-xs text-slate-500">Međunarodni standardni broj serijske publikacije</span>
            </div>

            <div
                class="grid gap-4 md:grid-cols-2 md:gap-5"
                :class="compact ? '' : 'lg:gap-6'"
            >
                <!-- Publisher block -->
                <section
                    v-if="bookInfo.publisher_name"
                    class="overflow-hidden rounded-xl bg-white/90 p-4 shadow-sm ring-1 ring-slate-900/[0.06] sm:p-5"
                >
                    <div class="flex items-start gap-3">
                        <div
                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-blue-600/10 text-blue-700"
                            aria-hidden="true"
                        >
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <h3 class="text-[11px] font-bold uppercase tracking-[0.14em] text-slate-500">
                                Izdavač
                            </h3>
                            <p class="mt-1 text-base font-semibold leading-snug text-slate-900">
                                {{ bookInfo.publisher_name }}
                            </p>
                            <p
                                v-if="bookInfo.publisher_address"
                                class="mt-2 text-sm leading-relaxed text-slate-600 whitespace-pre-line"
                            >
                                {{ bookInfo.publisher_address }}
                            </p>
                            <ul class="mt-4 space-y-2.5 text-sm text-slate-700">
                                <li v-if="bookInfo.publisher_phone" class="flex items-start gap-2.5">
                                    <span class="mt-0.5 text-slate-400" aria-hidden="true">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </span>
                                    <span>{{ bookInfo.publisher_phone }}</span>
                                </li>
                                <li v-if="bookInfo.publisher_email" class="flex items-start gap-2.5">
                                    <span class="mt-0.5 text-slate-400" aria-hidden="true">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </span>
                                    <a
                                        :href="'mailto:' + bookInfo.publisher_email"
                                        class="font-medium text-blue-700 underline decoration-blue-700/30 underline-offset-2 transition hover:text-blue-900 hover:decoration-blue-900/50"
                                    >{{ bookInfo.publisher_email }}</a>
                                </li>
                                <li v-if="bookInfo.publisher_website" class="flex items-start gap-2.5">
                                    <span class="mt-0.5 text-slate-400" aria-hidden="true">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                        </svg>
                                    </span>
                                    <a
                                        :href="websiteHref"
                                        class="font-medium text-blue-700 underline decoration-blue-700/30 underline-offset-2 transition hover:text-blue-900 hover:decoration-blue-900/50"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                    >{{ bookInfo.publisher_website }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </section>

                <!-- Roles column -->
                <div class="flex flex-col gap-4">
                    <section
                        v-if="bookInfo.for_publisher"
                        class="rounded-xl bg-white/90 p-4 shadow-sm ring-1 ring-slate-900/[0.06] sm:p-5"
                    >
                        <h3 class="text-[11px] font-bold uppercase tracking-[0.14em] text-slate-500">
                            Za izdavača
                        </h3>
                        <p class="mt-2 text-base font-semibold text-slate-900">
                            {{ bookInfo.for_publisher }}
                        </p>
                    </section>

                    <div
                        v-if="bookInfo.editor_in_chief || bookInfo.managing_editor"
                        class="grid gap-4 sm:grid-cols-2"
                    >
                        <section
                            v-if="bookInfo.editor_in_chief"
                            class="rounded-xl bg-gradient-to-br from-slate-50 to-white p-4 shadow-sm ring-1 ring-slate-900/[0.05] sm:p-5"
                        >
                            <h3 class="text-[11px] font-bold uppercase tracking-[0.14em] text-slate-500">
                                Glavna urednica
                            </h3>
                            <p class="mt-2 text-base font-semibold text-slate-900">
                                {{ bookInfo.editor_in_chief }}
                            </p>
                        </section>
                        <section
                            v-if="bookInfo.managing_editor"
                            class="rounded-xl bg-gradient-to-br from-slate-50 to-white p-4 shadow-sm ring-1 ring-slate-900/[0.05] sm:p-5"
                        >
                            <h3 class="text-[11px] font-bold uppercase tracking-[0.14em] text-slate-500">
                                Odgovorna urednica
                            </h3>
                            <p class="mt-2 text-base font-semibold text-slate-900">
                                {{ bookInfo.managing_editor }}
                            </p>
                        </section>
                    </div>
                </div>
            </div>

            <!-- Editorial full width -->
            <section
                v-if="editorialLines.length"
                class="mt-5 rounded-xl bg-white/90 p-4 shadow-sm ring-1 ring-slate-900/[0.06] sm:p-5"
            >
                <h3 class="text-[11px] font-bold uppercase tracking-[0.14em] text-slate-500">
                    Redakcija i recenzije
                </h3>
                <div class="mt-4 flex flex-wrap gap-2">
                    <span
                        v-for="(name, i) in editorialLines"
                        :key="i"
                        class="inline-flex items-center rounded-full border border-slate-200/90 bg-slate-50 px-3 py-1.5 text-xs font-medium text-slate-800 shadow-sm transition hover:border-slate-300 hover:bg-white"
                    >
                        {{ name }}
                    </span>
                </div>
            </section>
        </div>
    </div>
</template>
