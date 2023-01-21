<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import InputError from "@/Components/InputError.vue"
import FormInputLabel from "@/Components/FormInputLabel.vue"
import { Head } from '@inertiajs/inertia-vue3'
import {useForm } from "@inertiajs/inertia-vue3"
import SelectWithSearch from "@/Components/SelectWithSearch.vue"
import { ref } from 'vue'
import { XMarkIcon } from "@heroicons/vue/24/solid"
import Content from "@/Components/Content.vue"

//Layout
defineOptions({ layout: AuthenticatedLayout })

//PROPS
let props = defineProps({
    authors: Array,
    keywords: Array
})

//Form submitting
let form = useForm({
  title: '',
  year_published: null,
  inventory_number: null,
  signature: '',
  number_of_units: null,
  publisher: '',
  location_published: '',
  authors: [],
  newAuthors: [],
  keywords: [],
  newKeywords: [],
})

const submit = () => {
  form.post(route("books.store"))
}

let authorList = ref([])
let selectedAuthor = ref(props.authors[0])

let keywordList = ref([]);
let selectedKeyword = ref(props.keywords[0])

const changeAuthorSelection = (newselectedAuthor) =>{
    selectedAuthor.value = newselectedAuthor
}

const changeKeywordSelection = (newSelectedKeyword) =>{
    selectedKeyword.value = newSelectedKeyword
}

function addAuthor(){
    if (authorList.value.includes(selectedAuthor.value.name)){
        alert("Autor " + selectedAuthor.value.name + " je već dodan!")
        return;
    }
    
    authorList.value.push(selectedAuthor.value.name);
    
    if (selectedAuthor.value.id != null)
        form.authors.push(selectedAuthor.value);
    else 
        form.newAuthors.push(selectedAuthor.value.name);
    changeHeight(50)
}
function addKeyword(){
    if (keywordList.value.includes(selectedKeyword.value.name)){
        alert("Ključna riječ " + selectedKeyword.value.name + " je već dodana!")
        return;
    }
    
    keywordList.value.push(selectedKeyword.value.name);
    
    if (selectedKeyword.value.id != null)
        form.keywords.push(selectedKeyword.value);
    else 
        form.newKeywords.push(selectedKeyword.value.name);
    
    changeHeight(50);
}

function removeAuthorFromList(name){
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
    changeHeight(-50)
}

function removeKeywordFromList(name){
    //Remove from view
    let index = keywordList.value.indexOf(name);
    keywordList.value.splice(index, 1);
    //Remove from form parameters
    index = form.keywords.findIndex(function(keyword){
        return keyword.name === name
    })
    if (index > -1)
        form.keywords.splice(index, 1)
    else{
        index = form.newKeywords.indexOf(name)
        form.newKeywords.splice(index, 1);
    }
    changeHeight(-50)
}

const main = ref(null);

function changeHeight(value){
    let visina = main.value.offsetHeight;
    main.value.style.height = visina+value+"px";
}
</script>

<template>
    <Content>
        <Head title="Unos knjige" />
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Unos knjige</h2>
        </template>

        <div class="pt-4 pb-12">
            <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4" ref="main">
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
                                        <input type="number" name="number_of_units" id="number_of_units" v-model="form.number_of_units" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required>
                                        <InputError class="mt-2" :message="form.errors.number_of_units" :disabled="form.processing"/>
                                    </div>
                                </div>
                            </div>
                            <!-- Desna kolona forme -->
                            <div ref="dynamicColumn">
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
                                                        <XMarkIcon @click="removeAuthorFromList(author)" class="h-4 w-4 inline rm-bg" />
                                                    </span>
                                                </div>
                                            </th>                                            
                                        </tr>
                                    </tbody>
                                </table>
                            
                                <!-- Unos autora -->
                                <div class="grid gap-6 mb-6 grid-cols-3">
                                    <div class="col-span-2">
                                        <SelectWithSearch what="autora" :content="authors" @item-selected="changeAuthorSelection"/>
                                        <div v-show="form.errors.authors || form.errors.newAuthors">
                                            <p class="text-sm text-red-600 mt-2">
                                                Morate unijeti minimalno jednog autora!
                                            </p>
                                        </div>
                                    </div>
                                    <div class="pt-2">
                                        <button @click="addAuthor" type="button" class="py-2 px-3 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 w-full">Dodaj autora</button>
                                    </div>
                                </div>
                                <!-- Spisak tagova -->
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mb-4">
                                    <tbody>
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50  dark:text-gray-400">
                                            Ključne riječi
                                        </thead>
                                        <tr v-for="keyword in keywordList" :key="keyword" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white hover:bg-gray-200">
                                                <div class="flex">
                                                    <span>
                                                        <p class="inline">{{keyword}}</p>
                                                    </span>
                                                    <span class="ml-auto">
                                                        <XMarkIcon @click="removeKeywordFromList(keyword)" class="h-4 w-4 inline rm-bg" />
                                                    </span>
                                                </div>
                                            </th>                                            
                                        </tr>
                                    </tbody>
                                </table>
                            
                                <!-- Unos tagova -->
                                <div class="grid gap-6 mb-6 grid-cols-3">
                                    <div class="col-span-2">
                                        <SelectWithSearch what="ključnu riječ" :content="keywords" @item-selected="changeKeywordSelection"/>
                                        <div v-show="form.errors.keywords || form.errors.newKeywords">
                                            <p class="text-sm text-red-600 mt-2">
                                                Morate unijeti minimalno jednu ključnu riječ!
                                            </p>
                                        </div>
                                    </div>
                                    <div class="pt-2">
                                        <button @click="addKeyword" type="button" class="py-2 px-3 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 w-full">Dodaj ključnu riječ</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Kreiraj knjigu</button>
                    </form>
                </div>
            </div>
        </div>
    </Content>
</template>

<style scoped>
.rm-bg:hover{
    background-color: red;
    color:white;
    border-radius: 20px;
}
</style>