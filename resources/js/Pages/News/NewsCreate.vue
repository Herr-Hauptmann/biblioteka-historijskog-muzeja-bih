<script setup>
import { computed } from "vue";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import InputError from "@/Components/InputError.vue"
import Content from "@/Components/Content.vue"
import FormInputLabel from "@/Components/FormInputLabel.vue"
import { Head } from '@inertiajs/inertia-vue3'
import { useForm } from "@inertiajs/inertia-vue3"
import Editor from '@tinymce/tinymce-vue'

defineProps({
    apikey:String,
})

defineOptions({ layout: AuthenticatedLayout })

let form = useForm({
    title: '',
    description: '',
    article: '',
    image: null,
})

const submit = () => {
    form.post(route("news.store"))
}

let width = computed(() => {
    let value = "width: " + form.progress.percentage + '%';
    return value;
});

</script>

<template>
    <Head title="Unos priče" />
    <Content>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Unos priče iz biblioteke</h2>
        </template>

        <div class="pt-4 pb-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">

                    <form @submit.prevent="submit">
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <div>
                                    <FormInputLabel what="title" msg="Naziv priče" />
                                    <input type="text" name="title" id="title" v-model="form.title"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        required>
                                    <InputError class="mt-2" :message="form.errors.title" />
                                </div>
                                <div class="mt-3">
                                    <FormInputLabel what="description" msg="Opis priče" />
                                    <input type="text" name="description" id="description" v-model="form.description"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        required>
                                    <InputError class="mt-2" :message="form.errors.description" />
                                </div>
                                <div class="mt-3">
                                    <FormInputLabel what="image" msg="Slika vezana za priču" />
                                    <input name="image" @input="form.image = $event.target.files[0]"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                                        aria-describedby="image_help" id="image" type="file">
                                    <p class="mt-1 text-sm text-gray-500" id="image_help">Odaberite sliku vezanu za ovu
                                        priču</p>
                                    <div class="w-full bg-gray-200 rounded-full">
                                        <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                                            v-if="form.progress" :style="width" max="100">
                                            {{ form.progress.percentage }}%
                                        </div>
                                    </div>
                                    <InputError class="mt-2" :message="form.errors.image" />
                                </div>
                            </div>
                            <div>
                                <FormInputLabel what="article" msg="Sadržaj priče" />
                                <Editor v-model="form.article" :api-key="apikey" :init="{
                                    plugins: 'lists link image table code wordcount'
                                }" />
                            </div>
                        </div>

                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Kreiraj
                            priču</button>
                    </form>
                </div>
            </div>
        </div>
    </Content>
</template>

<style scoped>h1 {
    color: red !important;
}</style>