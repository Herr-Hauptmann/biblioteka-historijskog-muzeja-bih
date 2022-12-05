<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from "@/Components/InputError.vue";
import { Head } from '@inertiajs/inertia-vue3';
import {Link} from '@inertiajs/inertia-vue3'
import {useForm } from "@inertiajs/inertia-vue3";
import {ref} from 'vue';

const form = useForm({
  title: ref(null),
  author: ref(null),
  year_published: ref(null),
});

const submit = () => {
  form.post(route("books.store"), {
    onFinish: () => form.reset(),
  });
};

defineProps({
    logo_url: String,
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
                                <label for="title"   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Naziv djela</label>
                                <input type="text" name="title" id="title" :v-model="form.title" :ref="form.title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <InputError class="mt-2" :message="form.errors.title" />
                            </div>
                            <div>
                                <label for="author" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ime autora</label>
                                <input type="text" name="author" id="author" :v-model="form.author" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <InputError class="mt-2" :message="form.errors.author" />
                            </div>
                            <div>
                                <label for="year_published" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Godina izdavanja</label>
                                <input type="number" name="year_published" id="year_published" :v-model="form.year_published" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required>
                                <InputError class="mt-2" :message="form.errors.year_published" />
                            </div>
                        </div>

                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Kreiraj knjigu</button>
                    </form>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>