<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from "@/Components/InputError.vue";
import FormInputLabel from "@/Components/FormInputLabel.vue";
import { Head } from '@inertiajs/inertia-vue3';
import {useForm } from "@inertiajs/inertia-vue3";

let form = useForm({
  title: '',
  author: '',
  year_published: ''
});

const submit = () => {
  form.post(route("books.store"))
};

defineProps({
    logo_url: String
});

</script>

<template>
    <Head title="Unos knjige" />

    <AuthenticatedLayout :logo_url="logo_url">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Unos knjige</h2>
        </template>

        <div class="pt-4 pb-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    
                    <form @submit.prevent="submit">
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <FormInputLabel what="title" msg="Naziv djela"/>
                                <input type="text" name="title" id="title" v-model="form.title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <InputError class="mt-2" :message="form.errors.title" />
                            </div>
                            <div>
                                <FormInputLabel what="author" msg="Ime autora"/>
                                <input type="text" name="author" id="author" v-model="form.author" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <InputError class="mt-2" :message="form.errors.author" />
                            </div>
                            <div>
                                <FormInputLabel what="year_published" msg="Godina izdavanja"/>
                                <input type="number" name="year_published" id="year_published" v-model="form.year_published" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required>
                                <InputError class="mt-2" :message="form.errors.year_published" :disabled="form.processing"/>
                            </div>
                        </div>

                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Kreiraj knjigu</button>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>