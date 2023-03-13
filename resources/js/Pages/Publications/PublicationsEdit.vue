<script setup>
import { computed, ref, watch } from "vue";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import InputError from "@/Components/InputError.vue"
import Content from "@/Components/Content.vue"
import FormInputLabel from "@/Components/FormInputLabel.vue"
import { Head } from '@inertiajs/inertia-vue3'
import { useForm } from "@inertiajs/inertia-vue3"

defineOptions({ layout: AuthenticatedLayout })

const props = defineProps({
    publication: Object,
    pdf_icon: String
})

let form = useForm({
    _method: 'patch',
    title: props.publication.title,
    description: props.publication.description,
    publication: null,
})

const submit = () => {
    form.post(route("publications.update", props.publication.id))
}

let width = computed(() => {
    let value = "width: " + form.progress.percentage + '%';
    return value;
});

function back() {
    window.history.back();
}

let showUpload = ref(false);

const toggleUpload = () => {
    if (showUpload.value == true) {
        form.publication = null;
    }
    showUpload.value = !showUpload.value;
}

watch(form, () => {
    console.log(form);
})
</script>

<template>
    <Head title="Izmjena publikacije" />
    <Content>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Izmjena publikacije</h2>
        </template>

        <div class="pt-4 pb-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">

                    <form @submit.prevent="submit">
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <div class="mb-3">
                                    <FormInputLabel what="title" msg="Naziv publikacije" />
                                    <input type="text" name="title" id="title" v-model="form.title"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        required>
                                    <InputError class="mt-2" :message="form.errors.title" />
                                </div>
                                <div>
                                    <FormInputLabel what="description" msg="Opis publikacije" />
                                    <input type="text" name="description" id="description" v-model="form.description"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        required>
                                    <InputError class="mt-2" :message="form.errors.description" />
                                </div>
                            </div>
                            <div>
                                <div v-if="showUpload">
                                    <FormInputLabel what="name" msg="Ime autora" />
                                    <input name="publication" @input="form.publication = $event.target.files[0]"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                                        aria-describedby="publication_help" id="publication" type="file">
                                    <p class="mt-1 text-sm text-gray-500" id="publication_help">Odaberite publikaciju u pdf
                                        formatu</p>
                                    <div class="w-full bg-gray-200 rounded-full">
                                        <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                                            v-if="form.progress" :style="width" max="100">
                                            {{ form.progress.percentage }}%
                                        </div>
                                    </div>
                                    <button type="button"
                                        class="focus:outline-none text-white bg-red-500 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 "
                                        @click="toggleUpload">Odustani</button>
                                </div>
                                <div v-else>
                                    <a :href="route('publications.show', publication.id)" target="_blank"
                                        class="flex flex-col items-center">
                                        <img class="h-12 w-12" :src="pdf_icon" alt="Postojeća publikacija">
                                        <p class="mt-2">{{ publication.file_name }}</p>
                                    </a>
                                    <button type="button"
                                        class="block my-3 py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200"
                                        @click="toggleUpload()">Izmijeni datoteku</button>
                                </div>
                                <InputError class="mt-2" :message="form.errors.publication" />
                            </div>
                        </div>

                    <div class="flex justify-between">
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Uredi
                            publikaciju</button>
                        <button @click="back" type="button"
                            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Odustani</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</Content></template>