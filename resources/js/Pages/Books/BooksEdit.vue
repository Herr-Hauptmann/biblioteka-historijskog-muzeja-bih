<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import InputError from "@/Components/InputError.vue"
import FormInputLabel from "@/Components/FormInputLabel.vue"
import { Head } from '@inertiajs/vue3'
import { useForm } from "@inertiajs/vue3"
import SelectWithSearch from "@/Components/SelectWithSearch.vue"
import { ref, onMounted } from 'vue'
import { XMarkIcon } from "@heroicons/vue/24/solid"
import Content from "@/Components/Content.vue"

//Layout
defineOptions({ layout: AuthenticatedLayout })

//PROPS
let props = defineProps({
    book: Object,
    authors: Array,
    keywords: Array
})

//Form submitting
let form = useForm({
    title: props.book.title,
    year_published: props.book.year_published,
    inventory_number: props.book.inventory_number,
    signature: props.book.signature,
    number_of_units: props.book.number_of_units,
    publisher: props.book.publisher,
    location_published: props.book.location_published,
    authors: props.book.authors,
    newAuthors: [],
    keywords: props.book.keywords,
    newKeywords: [],
})

const submit = () => {
    form.patch(route("books.update", props.book.id))
}

let authorList = ref(props.book.authors.map(x => x.name))
let selectedAuthor = ref(props.authors)

let keywordList = ref(props.book.keywords.map(x => x.title))
let selectedKeyword = ref(props.keywords)

const changeAuthorSelection = (newselectedAuthor) => {
    selectedAuthor.value = newselectedAuthor
}

const changeKeywordSelection = (newSelectedKeyword) => {
    selectedKeyword.value = newSelectedKeyword
}

function addAuthor() {
    if (authorList.value.includes(selectedAuthor.value.name)) {
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
function addKeyword() {
    if (keywordList.value.includes(selectedKeyword.value.name)) {
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

function removeAuthorFromList(name) {
    //Remove from view
    let index = authorList.value.indexOf(name);
    authorList.value.splice(index, 1);
    //Remove from form parameters
    index = form.authors.findIndex(function (author) {
        return author.name === name
    })
    if (index > -1)
        form.authors.splice(index, 1)
    else {
        index = form.newAuthors.indexOf(name)
        form.newAuthors.splice(index, 1);
    }
    changeHeight(-50)
}

function removeKeywordFromList(name) {
    //Remove from view
    let index = keywordList.value.indexOf(name);
    keywordList.value.splice(index, 1);
    //Remove from form parameters
    index = form.keywords.findIndex(function (keyword) {
        return keyword.name === name
    })
    if (index > -1) {
        form.keywords.splice(index, 1)
        return
    }
    index = form.keywords.findIndex(function (keyword) {
        return keyword.title === name
    })
    if (index > -1) {
        form.keywords.splice(index, 1)
    }
    else {
        index = form.newKeywords.indexOf(name)
        form.newKeywords.splice(index, 1);
    }
    changeHeight(-50)
}

const main = ref(null);
let defaultHeight = null;
onMounted(() => {
    defaultHeight = main.value.offsetHeight
})

function changeHeight(value) {
    let visina = main.value.offsetHeight;
    if (value < 0 && visina - 50 <= defaultHeight)
        return
    main.value.style.height = visina + value + "px";
}
</script>

<template>

    <Head title="Izmjena knjige" />
    <Content>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Izmjena knjige</h2>
        </template>

        <div class="pt-4 pb-12">
            <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4" ref="main">
                    <form @submit.prevent="submit">
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <!-- Lijeva kolona forme -->
                            <div>
                                <div class="mb-3">
                                    <FormInputLabel what="signature" msg="Signatura" />
                                    <input type="text" name="signature" id="signature" v-model="form.signature"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        required>
                                    <InputError class="mt-2" :message="form.errors.signature" />
                                </div>
                                <div class="mb-3">
                                    <FormInputLabel what="title" msg="Naziv djela" />
                                    <input type="text" name="title" id="title" v-model="form.title"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        required>
                                    <InputError class="mt-2" :message="form.errors.title" />
                                </div>
                                <div class="mb-3">
                                    <FormInputLabel what="publisher" msg="Izdavač" />
                                    <input type="text" name="publisher" id="publisher" v-model="form.publisher"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        placeholder="">
                                    <InputError class="mt-2" :message="form.errors.publisher"
                                        :disabled="form.processing" />
                                </div>
                                <div class="mb-3 grid gap-2 md:grid-cols-2">
                                    <div>
                                        <FormInputLabel what="location_published" msg="Mjesto izdavanja" />
                                        <input type="text" name="location_published" id="location_published"
                                            v-model="form.location_published"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            placeholder="">
                                        <InputError class="mt-2" :message="form.errors.location_published"
                                            :disabled="form.processing" />
                                    </div>
                                    <div>
                                        <FormInputLabel what="year_published" msg="Godina izdavanja" />
                                        <input type="number" name="year_published" id="year_published"
                                            v-model="form.year_published"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            placeholder="">
                                        <InputError class="mt-2" :message="form.errors.year_published"
                                            :disabled="form.processing" />
                                    </div>
                                </div>
                                <div class="mb-3 grid gap-2 md:grid-cols-2">
                                    <div>
                                        <FormInputLabel what="inventory_number" msg="Inventarni broj" />
                                        <input type="text" name="inventory_number" id="inventory_number"
                                            v-model="form.inventory_number"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            placeholder="" required>
                                        <InputError class="mt-2" :message="form.errors.inventory_number"
                                            :disabled="form.processing" />
                                    </div>
                                    <div>
                                        <FormInputLabel what="number_of_units" msg="Broj jedinica" />
                                        <input type="number" name="number_of_units" id="number_of_units"
                                            v-model="form.number_of_units"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                            placeholder="" required>
                                        <InputError class="mt-2" :message="form.errors.number_of_units"
                                            :disabled="form.processing" />
                                    </div>
                                </div>
                            </div>
                            <!-- Desna kolona forme -->
                            <div ref="dynamicColumn">
                                <!-- Spisak autora -->
                                <table class="w-full text-sm text-left text-gray-500 mb-4">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                        Autori djela
                                    </thead>
                                    <tbody>
                                        <tr v-for="author in authorList" :key="author" class="bg-white border-b">
                                            <th scope="row"
                                                class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap hover:bg-gray-200">
                                                <div class="flex">
                                                    <span>
                                                        <p class="inline">{{ author }}</p>
                                                    </span>
                                                    <span class="ml-auto">
                                                        <XMarkIcon @click="removeAuthorFromList(author)"
                                                            class="h-4 w-4 inline rm-bg" />
                                                    </span>
                                                </div>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>

                                <!-- Unos autora -->
                                <div class="grid gap-6 mb-6 grid-cols-3">
                                    <div class="col-span-2">
                                        <SelectWithSearch what="autora" :content="authors"
                                            @item-selected="changeAuthorSelection" />
                                        <div v-show="form.errors.authors || form.errors.newAuthors">
                                            <p class="text-sm text-red-600 mt-2">
                                                {{ form.errors.authors }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="pt-2">
                                        <button @click="addAuthor" type="button"
                                            class="py-2 px-3 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 w-full">Dodaj
                                            autora</button>
                                    </div>
                                </div>
                                <!-- Spisak tagova -->
                                <table class="w-full text-sm text-left text-gray-500 mb-4">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                        Ključne riječi
                                    </thead>
                                    <tbody>

                                        <tr v-for="keyword in keywordList" :key="keyword" class="bg-white border-b">
                                            <th scope="row"
                                                class="py-4 px-6 font-medium text-gray-900 whitespace-nowraphover:bg-gray-200">
                                                <div class="flex">
                                                    <span>
                                                        <p class="inline">{{ keyword }}</p>
                                                    </span>
                                                    <span class="ml-auto">
                                                        <XMarkIcon @click="removeKeywordFromList(keyword)"
                                                            class="h-4 w-4 inline rm-bg" />
                                                    </span>
                                                </div>
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>

                                <!-- Unos tagova -->
                                <div class="grid gap-6 mb-6 grid-cols-3">
                                    <div class="col-span-2">
                                        <SelectWithSearch what="ključnu riječ" :content="keywords"
                                            @item-selected="changeKeywordSelection" />
                                        <div v-show="form.errors.keywords || form.errors.newKeywords">
                                            <p class="text-sm text-red-600 mt-2">
                                                Morate unijeti minimalno jednu ključnu riječ!
                                            </p>
                                        </div>
                                    </div>
                                    <div class="pt-2">
                                        <button @click="addKeyword" type="button"
                                            class="py-2 px-3 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 w-full">Dodaj
                                            ključnu riječ</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Uredi
                            knjigu</button>
                    </form>
                </div>
            </div>
        </div>
    </Content>
</template>

<style scoped>
.rm-bg:hover {
    background-color: red;
    color: white;
    border-radius: 20px;
}
</style>