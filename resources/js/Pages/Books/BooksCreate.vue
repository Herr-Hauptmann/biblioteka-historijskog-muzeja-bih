<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import InputError from "@/Components/InputError.vue"
import FormInputLabel from "@/Components/FormInputLabel.vue"
import { Head } from '@inertiajs/inertia-vue3'
import {useForm } from "@inertiajs/inertia-vue3"
import AuthorsInput from "@/Components/Authors/AuthorsInput.vue"
import { ref } from 'vue'
import { XMarkIcon } from "@heroicons/vue/24/solid"

//PROPS
let props = defineProps({
    authors: Array
})

//Form submitting
let form = useForm({
  title: '',
  authors: [],
  newAuthors: [],
  year_published: '',
  inventory_number: null,
  signature: '',
  number_of_units: null,
  publisher: '',
  location_published: '',
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
    if (authorList.value.includes(selected.value.name)){
        alert("Autor " + selected.value.name + " je vec dodan!")
        return;
    }
    
    authorList.value.push(selected.value.name);
    
    if (selected.value.id != null)
        form.authors.push(selected.value);
    else 
        form.newAuthors.push(selected.value.name);
}

function removeFromList(name){
    //Remove from view
    let index = authorList.value.indexOf(name);
    authorList.value.splice(index, 1);
    //Remove from form parameters
    index = form.authors.findIndex(function(author){
        return author.name === name
    })
    if (index > -1)
        form.authors.splice(index, 1)
    else{
        index = form.newAuthors.indexOf(name)
        form.newAuthors.splice(index, 1);
    }
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
                                <div class="mb-3">
                                    <FormInputLabel what="signature" msg="Signatura"/>
                                    <input type="text" name="signature" id="signature" v-model="form.signature" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                    <InputError class="mt-2" :message="form.errors.signature" />
                                </div>
                                <div class="mb-3">
                                    <FormInputLabel what="title" msg="Naziv djela"/>
                                    <input type="text" name="title" id="title" v-model="form.title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                    <InputError class="mt-2" :message="form.errors.title" />
                                </div>
                                <div class="mb-3">
                                    <FormInputLabel what="publisher" msg="Izdavač"/>
                                    <input type="text" name="publisher" id="publisher" v-model="form.publisher" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required>
                                    <InputError class="mt-2" :message="form.errors.publisher" :disabled="form.processing"/>
                                </div>
                                <div class="mb-3 grid gap-2 md:grid-cols-2">
                                    <div>
                                        <FormInputLabel what="location_published" msg="Mjesto izdavanja"/>
                                        <input type="text" name="location_published" id="location_published" v-model="form.location_published" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required>
                                        <InputError class="mt-2" :message="form.errors.location_published" :disabled="form.processing"/>
                                    </div>
                                    <div>
                                        <FormInputLabel what="year_published" msg="Godina izdavanja"/>
                                        <input type="number" name="year_published" id="year_published" v-model="form.year_published" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required>
                                        <InputError class="mt-2" :message="form.errors.year_published" :disabled="form.processing"/>
                                    </div>
                                </div>
                                <div class="mb-3 grid gap-2 md:grid-cols-2">
                                    <div>
                                        <FormInputLabel what="inventory_number" msg="Inventarni broj"/>
                                        <input type="number" name="inventory_number" id="inventory_number" v-model="form.inventory_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required>
                                        <InputError class="mt-2" :message="form.errors.inventory_number" :disabled="form.processing"/>
                                    </div>
                                    <div>
                                        <FormInputLabel what="number_of_units" msg="Broj jedinica"/>
                                        <input type="integer" name="number_of_units" id="number_of_units" v-model="form.number_of_units" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required>
                                        <InputError class="mt-2" :message="form.errors.number_of_units" :disabled="form.processing"/>
                                    </div>
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
                                                <div class="flex">
                                                    <span>
                                                        <p class="inline">{{author}}</p>
                                                    </span>
                                                    <span class="ml-auto">
                                                        <XMarkIcon @click="removeFromList(author)" class="h-4 w-4 inline rm-bg" />
                                                    </span>
                                                </div>
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

<style scoped>
.rm-bg:hover{
    background-color: red;
    color:white;
    border-radius: 20px;
}
</style>