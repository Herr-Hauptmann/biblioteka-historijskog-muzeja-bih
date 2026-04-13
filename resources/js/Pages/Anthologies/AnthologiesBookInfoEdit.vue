<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Content from '@/Components/Content.vue'
import InputError from '@/Components/InputError.vue'
import FormInputLabel from '@/Components/FormInputLabel.vue'

defineOptions({ layout: AuthenticatedLayout })

const props = defineProps({
    bookInfo: Object,
})

const form = useForm({
    issn: props.bookInfo.issn ?? '',
    publisher_name: props.bookInfo.publisher_name ?? '',
    publisher_address: props.bookInfo.publisher_address ?? '',
    publisher_phone: props.bookInfo.publisher_phone ?? '',
    publisher_email: props.bookInfo.publisher_email ?? '',
    publisher_website: props.bookInfo.publisher_website ?? '',
    for_publisher: props.bookInfo.for_publisher ?? '',
    editorial_reviews: props.bookInfo.editorial_reviews ?? '',
    editor_in_chief: props.bookInfo.editor_in_chief ?? '',
    managing_editor: props.bookInfo.managing_editor ?? '',
})

const submit = () => {
    form.put(route('anthologies.book-info.update'))
}
</script>

<template>
    <Head title="Podaci o zborniku" />
    <Content>
        <template #header>
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Podaci o zborniku (ISSN, izdavač, redakcija…)
                </h2>
                <Link
                    :href="route('anthologies.index')"
                    class="text-sm font-medium text-blue-700 hover:underline"
                >
                    ← Nazad na brojeve zbornika
                </Link>
            </div>
        </template>

        <div class="pt-4 pb-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 md:p-6">
                    <p class="text-sm text-gray-600 mb-6">
                        Ovi podaci odnose se na cjelinu zbornika. Pojedinačne PDF sekcije uređujete na listi brojeva.
                    </p>

                    <form @submit.prevent="submit" class="space-y-5">
                        <div>
                            <FormInputLabel what="issn" msg="ISSN (npr. 2566 - 3747)" />
                            <input
                                id="issn"
                                v-model="form.issn"
                                type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            >
                            <InputError class="mt-2" :message="form.errors.issn" />
                        </div>

                        <div>
                            <FormInputLabel what="publisher_name" msg="Izdavač — naziv" />
                            <input
                                id="publisher_name"
                                v-model="form.publisher_name"
                                type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            >
                            <InputError class="mt-2" :message="form.errors.publisher_name" />
                        </div>
                        <div>
                            <FormInputLabel what="publisher_address" msg="Izdavač — adresa" />
                            <textarea
                                id="publisher_address"
                                v-model="form.publisher_address"
                                rows="2"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            />
                            <InputError class="mt-2" :message="form.errors.publisher_address" />
                        </div>
                        <div class="grid gap-4 md:grid-cols-2">
                            <div>
                                <FormInputLabel what="publisher_phone" msg="Telefon" />
                                <input
                                    id="publisher_phone"
                                    v-model="form.publisher_phone"
                                    type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                >
                                <InputError class="mt-2" :message="form.errors.publisher_phone" />
                            </div>
                            <div>
                                <FormInputLabel what="publisher_email" msg="E-mail" />
                                <input
                                    id="publisher_email"
                                    v-model="form.publisher_email"
                                    type="email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                >
                                <InputError class="mt-2" :message="form.errors.publisher_email" />
                            </div>
                        </div>
                        <div>
                            <FormInputLabel what="publisher_website" msg="Web stranica (npr. www.muzej.ba)" />
                            <input
                                id="publisher_website"
                                v-model="form.publisher_website"
                                type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            >
                            <InputError class="mt-2" :message="form.errors.publisher_website" />
                        </div>

                        <div>
                            <FormInputLabel what="for_publisher" msg="Za izdavača" />
                            <input
                                id="for_publisher"
                                v-model="form.for_publisher"
                                type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            >
                            <InputError class="mt-2" :message="form.errors.for_publisher" />
                        </div>

                        <div>
                            <FormInputLabel what="editorial_reviews" msg="Redakcija i recenzije (jedno ime po liniji)" />
                            <textarea
                                id="editorial_reviews"
                                v-model="form.editorial_reviews"
                                rows="8"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 font-mono"
                            />
                            <InputError class="mt-2" :message="form.errors.editorial_reviews" />
                        </div>

                        <div class="grid gap-4 md:grid-cols-2">
                            <div>
                                <FormInputLabel what="editor_in_chief" msg="Glavna urednica" />
                                <input
                                    id="editor_in_chief"
                                    v-model="form.editor_in_chief"
                                    type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                >
                                <InputError class="mt-2" :message="form.errors.editor_in_chief" />
                            </div>
                            <div>
                                <FormInputLabel what="managing_editor" msg="Odgovorna urednica" />
                                <input
                                    id="managing_editor"
                                    v-model="form.managing_editor"
                                    type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                >
                                <InputError class="mt-2" :message="form.errors.managing_editor" />
                            </div>
                        </div>

                        <div class="flex gap-3 pt-2">
                            <button
                                type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5"
                                :disabled="form.processing"
                            >
                                Sačuvaj podatke
                            </button>
                            <Link
                                :href="route('anthologies.index')"
                                class="py-2.5 px-5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50"
                            >
                                Odustani
                            </Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </Content>
</template>
