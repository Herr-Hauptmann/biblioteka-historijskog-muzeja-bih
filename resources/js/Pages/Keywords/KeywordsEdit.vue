<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from "@/Components/InputError.vue";
import Content from "@/Components/Content.vue";
import FormInputLabel from "@/Components/FormInputLabel.vue";
import { Head } from '@inertiajs/inertia-vue3';
import {useForm } from "@inertiajs/inertia-vue3";

defineOptions({ layout: AuthenticatedLayout })

const props = defineProps({
    keyword: Object
})

let form = useForm({
  title: props.keyword.title,
})

const submit = () => {
  form.patch(route("keywords.update", props.keyword.id));
}
</script>

<template>
    <Head title="Izmjena ključne riječi" />
    <Content>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Izmjena ključne riječi</h2>
        </template>

        <div class="pt-4 pb-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    
                    <form @submit.prevent="submit">
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <FormInputLabel what="title" msg="Naslov ključne riječi"/>
                                <input type="text" name="title" id="title" v-model="form.title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <InputError class="mt-2" :message="form.errors.title" />
                            </div>
                        </div>      

                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Izmijeni ključnu riječ</button>
                    </form>
                </div>
            </div>
        </div>
    </Content>
</template>