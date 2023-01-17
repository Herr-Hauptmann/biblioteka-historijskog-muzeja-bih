<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import InputError from "@/Components/InputError.vue"
import FormInputLabel from "@/Components/FormInputLabel.vue"
import { Head } from '@inertiajs/inertia-vue3'
import {useForm } from "@inertiajs/inertia-vue3"
import AuthorsInput from "@/Components/Authors/AuthorsInput.vue"
import { ref } from 'vue'

//PROPS
let props = defineProps({
    authors: Array
})

//Form submitting
let form = useForm({
  title: '',
  authors: [],
  newAuthors: [],
  year_published: ''
})

const submit = () => {
  form.post(route("books.store"))
}

let authorList = ref([]);
let selected = ref(props.authors[0]);

const changeSelection = (newSelected) =>{
    selected.value = newSelected;
}

function addAuthor(){
    if (authorList.value.includes(selected.value.name))
        return;
    
    authorList.value.push(selected.value.name);
    
    if (selected.value.id != null)
        form.authors.push(selected.value);
    else 
        form.newAuthors.push(selected.value.name);
}

function removeFromList(name){
    
}

</script>

<template>
    <Head title="Unos knjige" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Unos knjige</h2>
        </template>

        <div class="pt-4 pb-12">
            <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8 ">
                <!-- izbaci ovaj minh -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 min-h-screen">
                    
                    <form @submit.prevent="submit">
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <!-- Lijeva kolona forme -->
                            <div>

                                <div>
                                    <FormInputLabel what="title" msg="Naziv djela"/>
                                    <input type="text" name="title" id="title" v-model="form.title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                    <InputError class="mt-2" :message="form.errors.title" />
                                </div>
                                <div class="mt-3">
                                    <FormInputLabel what="year_published" msg="Godina izdavanja"/>
                                    <input type="number" name="year_published" id="year_published" v-model="form.year_published" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required>
                                    <InputError class="mt-2" :message="form.errors.year_published" :disabled="form.processing"/>
                                </div>
                            </div>
                            <!-- Desna kolona forme -->
                            <div>
                                <!-- Spisak autora -->
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mb-4">
                                    <tbody>
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50  dark:text-gray-400">
                                            Autori djela
                                        </thead>
                                        <tr v-for="author in authorList" :key="author" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white hover:bg-gray-200">
                                                {{ author }}
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                                  
                                <!-- Unos autora -->
                                <div class="grid gap-6 mb-6 grid-cols-3">
                                    <div class="col-span-2">
                                        <AuthorsInput :people="authors" @writer-selected="changeSelection"/>
                                        <InputError class="mt-2" :message="form.errors.authorIds" />
                                    </div>
                                    <div class="pt-2">
                                        <button @click="addAuthor" type="button" class="py-2 px-3 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Dodaj autora</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Kreiraj knjigu</button>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>