<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import { Head } from '@inertiajs/inertia-vue3'
import { Disclosure, DisclosureButton, DisclosurePanel } from '@headlessui/vue'
import { ChevronUpIcon } from '@heroicons/vue/20/solid'
defineOptions({ layout: GuestLayout })
const props = defineProps({
    photo_url: String,
})

const questions = [
    {
        title: "Kako istraživati u biblioteci Historijskog muzeja BiH?",
        answer: "Prvi korak je da se pismenim putem obratite muzejskom osoblju, sa objašnjenom temom istraživanja ili prijedlogom literature. Potom će Vam se javiti voditelj biblioteke sa daljim uputama i sugestijama.",
    },
    {
        title: "Da li se knjige iz biblioteke mogu iznositi izvan čitaonice?",
        answer: "Biblioteka Historijskog muzeja BiH je zatvorenog tipa: knjige se koriste isključivo u muzejskoj čitaonici. Muzejski tim je korisnicima biblioteke osigurao udoban radni kutak i stručnu pomoć pri istraživanjima u muzejskoj čitaonici.",
    },
    {
        title: "Da li muzej dozvoljava fotografisanje ili kopiranje građe?",
        answer: "Korisnicima biblioteke je omogućeno da umnože 20% publikacije.",
    },
    {
        title: "Da li se korištenje biblioteke plaća?",
        answer: "Korištenje muzejske biblioteke je besplatno. Ipak, muzej vodi evidencije o korisnicima građe, pa će Vas muzejsko osoblje zamoliti da se registrujete u Knjigu korisnika biblioteke.",
    },
    {
        title: "Kada mogu koristi biblioteku?",
        answer: "Biblioteku možete koristiti svakim radnim danom od do sati - ukoliko Vam ponuđeno vrijeme ne odgovara, možete se obratiti voditelju biblioteke za pomoć i eventualne dodatne termine za istraživanje.",
    },
    {
        title: "Koliko često mogu koristiti biblioteku?",
        answer: "Biblioteku možete koristiti koliko god želite i trebate. Historijski muzej BiH je otvorena, javna institucija i stoji na raspolaganju istraživačima.",
    },
    {
        title: "Mogu li doprinijeti radu biblioteke?",
        answer: "Možete, naravno! Biblioteku možete podržati donacijama knjiga ili direktnim donacijama upućenim prema Historijskom muzeju BiH. Također, možete volontirati u muzejskoj biblioteci - za bibliotekarski angažman popunite obrazac o volontiranju na stranici muzeja.",
    },
]

</script>

<template>
    <Head title="Pitanja" />
    <div class="container min-h-screen">
        <div class="grid grid-cols-2">
            <div>
                <img :src="photo_url" alt="slika" class="h-screen">
            </div>
            <div class="w-full px-4 pt-16">
                <div class="mx-auto w-full max-w-xl rounded-2xl bg-white p-2">
                    <h2 class="font text-xl mb-12 font-bold tracking-tight text-gray-900 sm:text-6xl">
                        Često postavljana pitanja
                    </h2>
                    <Disclosure v-for="question in questions" :key="question.title" as="div" class="mt-2" v-slot="{ open }">
                        <DisclosureButton
                            class="flex w-full justify-between rounded-lg bg-grey-100 px-4 py-2 text-left text-sm font-medium text-grey-900 hover:bg-slate-700 hover:text-white focus:outline-none focus-visible:ring focus-visible:ring-grey-500 focus-visible:ring-opacity-75">
                            <span>{{question.title}}</span>
                            <ChevronUpIcon :class="open ? 'rotate-180 transform' : ''" class="h-5 w-5 text-grey-500" />
                        </DisclosureButton>
                        <DisclosurePanel class="px-4 pt-4 pb-2 text-sm text-gray-500">
                            {{question.answer}}
                        </DisclosurePanel>
                    </Disclosure>
                </div>
            </div>


        </div>
    </div>
</template>
<style scoped></style>