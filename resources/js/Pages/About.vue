<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'

defineOptions({ layout: GuestLayout })


let title = "Biblioteka Historijskog muzeja Bosne i Hercegovine"
let button = "Pretraži muzejsku građu"
const props = defineProps({
    photo1_url: String,
    photo2_url: String,
    photo3_url: String,
    photo4_url: String,
    photo5_url: String,
    photo6_url: String,
    photo7_url: String,
})
</script>

<template>
    <div class="relative overflow-hidden bg-white">
        <div class="pt-16 pb-80 sm:pt-24 sm:pb-40 lg:pt-16 lg:pb-48">
            <div class="relative mx-auto max-w-7xl px-4 sm:static sm:px-6 lg:px-8">
                <div class="sm:max-w-lg">
                    <h1 class="font text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">{{ title }}</h1>
                    <p class="mt-4 text-xl text-gray-500">
                        Iako su prve knjige inventarisane još 1947. godine, prava organizacija i cjelokupni razvoj
                        biblioteke kao
                        zasebne muzejske kolekcije započeo je 1963. godine, kada se muzej preselio u novu zgradu i time
                        biblioteka dobila namjenski prostor i adekvatnu čitaonicu. Biblioteka je u prvoj fazi djelovanja
                        muzeja
                        (1945.-1990.) bila usmjerena na prikupljanje i stručnu obradu knjiga vezanih za Drugi svjetski rat i
                        socijalistički period, te tako ne čudi da su izrazito vrijedne publikacije iz Drugog svjetskog rata,
                        uključujući izdanja prava i regulacija Nezavisne države Hrvatske, zauzele nekoliko redova na
                        policama.
                        Poseban dio kolekcije sastoji se od periodike koja pokriva austro-ugarski period, materijale koji su
                        nastali
                        tokom Jugoslavije, te aktuelne periodike. Na vrhuncu djelovanja (1965.-1990.), muzejska biblioteka
                        je
                        uspješnom razmjenom sa akademskim institucijama bivše Jugoslavije znatno unaprijeđena.
                        Najznačajnija periodika iz cijele zemlje postale je dio kolekcije.
                    </p>
                    <p class="mt-4 text-xl text-gray-500">
                        Kontekst u kojem djeluje muzej se odražavao na razvoj bibliotečke djelatnosti. Nakon rata
                        1992.-1995.
                        muzej ostaje bez pravnog statusa i finansijske podrške države. Unatoč brojnim problemima, biblioteka
                        se
                        razvija: knjiški fond se obogaćuje donacijama institucija i pojedinaca, a u muzejskoj biblioteci se
                        ispisuju i
                        istražuju priče. Važno mjesto u prikupljačkoj aktivnosti biblioteke zauzimaju naslovi koji se tiču
                        rata u
                        Bosni i Hercegovini 1992.-1995. U prostoru čitaonice se redovno organiziraju radionice za djecu, a
                        na
                        zidovima čitaonice je stalna postavka „Zapis o Marian Wenzel“. Muzejska biblioteka i čitaonica se
                        renoviraju na svim nivoima - zadržavajući autentičnost prostora, bibliotečki labirint se razvija
                        prema
                        potrebama muzeja i savremenog društva.
                    </p>
                </div>
                <div>
                    <div class="mt-10">
                        <!-- Decorative image grid -->
                        <div aria-hidden="true"
                            class="pointer-events-none lg:absolute lg:inset-y-0 lg:mx-auto lg:w-full lg:max-w-7xl">
                            <div
                                class="absolute transform sm:left-1/2 sm:top-0 sm:translate-x-8 lg:left-1/2 lg:top-1/2 lg:-translate-y-1/2 lg:translate-x-8">
                                <div class="flex items-center space-x-6 lg:space-x-8">
                                    <div class="grid flex-shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8">
                                        <div class="h-64 w-44 overflow-hidden rounded-lg sm:opacity-0 lg:opacity-100">
                                            <img :src="photo1_url" alt="Slika 1"
                                                class="h-full w-full object-cover object-center">
                                        </div>
                                        <div class="h-64 w-44 overflow-hidden rounded-lg">
                                            <img :src="photo2_url" alt="Slika 2"
                                                class="h-full w-full object-cover object-center">
                                        </div>
                                    </div>
                                    <div class="grid flex-shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8">
                                        <div class="h-64 w-44 overflow-hidden rounded-lg">
                                            <img :src="photo3_url" alt="Slika 3"
                                                class="h-full w-full object-cover object-center">
                                        </div>
                                        <div class="h-64 w-44 overflow-hidden rounded-lg">
                                            <img :src="photo4_url" alt="Slika 4"
                                                class="h-full w-full object-cover object-center">
                                        </div>
                                        <div class="h-64 w-44 overflow-hidden rounded-lg">
                                            <img :src="photo5_url" alt="Slika 5"
                                                class="h-full w-full object-cover object-center">
                                        </div>
                                    </div>
                                    <div class="grid flex-shrink-0 grid-cols-1 gap-y-6 lg:gap-y-8">
                                        <div class="h-64 w-44 overflow-hidden rounded-lg">
                                            <img :src="photo6_url" alt="Slika 6"
                                                class="h-full w-full object-cover object-center">
                                        </div>
                                        <div class="h-64 w-44 overflow-hidden rounded-lg">
                                        <img :src="photo7_url" alt="Slika 7"
                                            class="h-full w-full object-cover object-center">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="#"
                        class="inline-block rounded-md border border-transparent bg-indigo-600 py-3 px-8 text-center font-medium text-white hover:bg-indigo-700">{{button}}</a>
                </div>
            </div>
        </div>
    </div>
</div></template>

<style></style>