<template>
    <Popover class="relative bg-white z-10">
    <div class="mx-auto max-w-7xl px-4 sm:px-6">
      <div class="flex items-center justify-between border-gray-100 py-6 md:justify-start md:space-x-10">
        <div class="flex justify-start lg:w-0 lg:flex-1">
          <Link :href="route('home')">
            <span class="sr-only">Historijski muzej BiH</span>
            <img class="h-8 w-auto sm:h-10" :src="$page.props.images.logoSmall" alt="Historijski muzej BiH" />
          </Link>
        </div>
        <div class="-my-2 -mr-2 md:hidden">
          <PopoverButton class="inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
            <Bars3Icon class="h-6 w-6" aria-hidden="true" />
          </PopoverButton>
        </div>
        <PopoverGroup as="nav" class="hidden space-x-10 md:flex">

          <Link :href="route('books.list')" class="text-base font-medium text-gray-500 hover:text-gray-900">Naslovi</Link>
          <Link :href="route('about')" class="text-base font-medium text-gray-500 hover:text-gray-900">O biblioteci</Link>

          <Popover class="relative" v-slot="{ open }">
            <PopoverButton :class="[open ? 'text-gray-900' : 'text-gray-500', 'group inline-flex items-center rounded-md bg-white text-base font-medium hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2']">
              <span>Više</span>
              <ChevronDownIcon :class="[open ? 'text-gray-600' : 'text-gray-400', 'ml-2 h-5 w-5 group-hover:text-gray-500']" aria-hidden="true" />
            </PopoverButton>

            <transition enter-active-class="transition ease-out duration-200" enter-from-class="opacity-0 translate-y-1" enter-to-class="opacity-100 translate-y-0" leave-active-class="transition ease-in duration-150" leave-from-class="opacity-100 translate-y-0" leave-to-class="opacity-0 translate-y-1">
              <PopoverPanel class="absolute left-1/2 z-10 mt-3 w-screen max-w-md -translate-x-1/2 transform px-2 sm:px-0">
                <div class="overflow-hidden rounded-lg shadow-lg ring-1 ring-black ring-opacity-5">
                  <div class="relative grid gap-6 bg-white px-5 py-6 sm:gap-8 sm:p-8">
                    <a v-for="item in resources" :key="item.name" :href="item.href" class="-m-3 flex items-start rounded-lg p-3 hover:bg-gray-50">
                      <component :is="item.icon" class="h-6 w-6 flex-shrink-0 text-indigo-600" aria-hidden="true" />
                      <div class="ml-4">
                        <p class="text-base font-medium text-gray-900">{{ item.name }}</p>
                        <p class="mt-1 text-sm text-gray-500">{{ item.description }}</p>
                      </div>
                    </a>
                  </div>
                  <div class="bg-gray-50 px-5 py-3 sm:px-8 sm:py-3">
                    <div>
                      <h3 class="text-base font-medium text-gray-500">Priče iz biblioteke</h3>
                      <ul role="list" class="mt-4 space-y-4">
                        <li v-for="post in recentPosts" :key="post.id" class="truncate text-base">
                          <a :href="route('news.show', post.id)" class="font-medium text-gray-900 hover:text-gray-700">{{ post.title }}</a>
                        </li>
                      </ul>
                    </div>
                    <div class="mt-5 text-sm">
                      <Link :href="route('news.list')" class="font-medium text-indigo-600 hover:text-indigo-500">
                        Pogledaj sve priče...
                        <span aria-hidden="true"> &rarr;</span>
                      </Link>
                    </div>
                  </div>
                </div>
              </PopoverPanel>
            </transition>
          </Popover>
        </PopoverGroup>
        <div class="hidden items-center justify-end md:flex md:flex-1 lg:w-0">
          <div v-if="$page.props.auth.user">
            <Popover class="relative" v-slot="{ open }">
            <PopoverButton :class="[open ? 'text-gray-900' : 'text-gray-500', 'group inline-flex items-center rounded-md bg-white text-base font-medium hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2']">
              <span>{{$page.props.auth.user.name}}</span>
              <ChevronDownIcon :class="[open ? 'text-gray-600' : 'text-gray-400', 'ml-2 h-5 w-5 group-hover:text-gray-500']" aria-hidden="true" />
            </PopoverButton>

            <transition enter-active-class="transition ease-out duration-200" enter-from-class="opacity-0 translate-y-1" enter-to-class="opacity-100 translate-y-0" leave-active-class="transition ease-in duration-150" leave-from-class="opacity-100 translate-y-0" leave-to-class="opacity-0 translate-y-1">
              <PopoverPanel class="absolute left-1/2 z-10 mt-3 w-screen max-w-max -translate-x-1/2 transform px-2 sm:px-0">
                <div class="overflow-hidden rounded-lg shadow-lg ring-1 ring-black ring-opacity-5">
                  <div class="relative grid gap-6 bg-white px-5 py-6 sm:gap-8 sm:p-8">
                    <Link v-for="item in admin" :key="item.name" :href="item.href" :as="item.as" :method="item.method" class="-m-3 flex items-start rounded-lg p-3 hover:bg-gray-50">
                      <component :is="item.icon" class="h-6 w-6 flex-shrink-0 text-indigo-600" aria-hidden="true" />
                      <div class="ml-4">
                        <p class="text-base font-medium text-gray-900">{{ item.name }}</p>
                      </div>
                    </Link>
                  </div>
                </div>
              </PopoverPanel>
            </transition>
          </Popover>
          </div>
          <Link v-else :href="route('login')" class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900">Admin</Link>
        </div>
      </div>
    </div>

    <transition enter-active-class="duration-200 ease-out" enter-from-class="opacity-0 scale-95" enter-to-class="opacity-100 scale-100" leave-active-class="duration-100 ease-in" leave-from-class="opacity-100 scale-100" leave-to-class="opacity-0 scale-95">
      <PopoverPanel focus class="absolute inset-x-0 top-0 origin-top-right transform p-2 transition md:hidden">
        <div class="divide-y-2 divide-gray-50 rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5">
          <div class="px-5 pt-5 pb-6">
            <div class="flex items-center justify-between">
              <Link :href="route('home')">
                <img class="h-8 w-auto" :src="$page.props.images.logoSmall" alt="Biblioteka Historijskog muzeja BiH" />
              </Link>
              <div class="-mr-2">
                <PopoverButton class="inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                  <span class="sr-only">Zatvori meni</span>
                  <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                </PopoverButton>
              </div>
            </div>
            <div class="mt-6">
              <nav class="grid gap-y-8">
                <a v-for="item in solutions" :key="item.name" :href="item.href" class="-m-3 flex items-center rounded-md p-3 hover:bg-gray-50">
                  <component :is="item.icon" class="h-6 w-6 flex-shrink-0 text-indigo-600" aria-hidden="true" />
                  <span class="ml-3 text-base font-medium text-gray-900">{{ item.name }}</span>
                </a>
              </nav>
            </div>
          </div>
          <div class="space-y-6 pb-6 px-5">
            <div class="">
              <h3 class="text-base font-medium text-gray-500 pb-3 mt-2">Priče iz biblioteke</h3>
              <Link v-for="item in recentPosts" :key="item.title" :href="route('news.show', item.id)"  class="block pb-3 text-base font-medium text-gray-900 hover:text-gray-700">{{ item.title }}</Link>
              <Link :href="route('news.list')" class="block pb-3 font-bold text-gray-500 hover:text-gray-700">Pregledaj sve priče...</Link>
            </div>
            <div>
              <Link :href="route('login')" class="flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700">Admin</Link>
            </div>
          </div>
        </div>
      </PopoverPanel>
    </transition>
  </Popover>

</template>

<script setup>
import {Link} from '@inertiajs/vue3';
import {ref} from 'vue';
import { Popover, PopoverButton, PopoverGroup, PopoverPanel } from '@headlessui/vue';
import {
  MagnifyingGlassIcon,
  BookOpenIcon,
  Bars3Icon,
  XMarkIcon,
  InformationCircleIcon,
  QuestionMarkCircleIcon,
  LightBulbIcon,
  UserIcon,
  PencilSquareIcon
} from '@heroicons/vue/24/outline'
import { 
  ChevronDownIcon,
  ArrowLeftOnRectangleIcon,
 } from '@heroicons/vue/24/solid'


 //Hamburger menu content
const solutions = [
  {
    name: 'Naslovi', 
    description: 'Pregledaj naslove', 
    href: route('books.list'), 
    icon: MagnifyingGlassIcon
  },
  {
    name: 'O biblioteci', 
    description: 'Detaljne informacije o našoj biblioteci', 
    href: route('about'), 
    icon: InformationCircleIcon
  },
  {
    name: ' Zbornik radova HMBiH',
    description: 'Pogledajte online sadržaj biblioteke',
    href: route('publications.list'),
    icon: BookOpenIcon,
  },
  {
    name: 'FAQ',
    description: 'Odgovori na često postavljena pitanja',
    href: route('faq'),
    icon: LightBulbIcon,
  },
  // {
  //   name: 'Pridruži se',
  //   description: 'Postanite član naše biblioteke',
  //   href: '#',
  //   icon: PencilIcon,
  // },
  { 
    name: 'Pošalji upit', 
    description: 'Postavite nam pitanje', 
    href: route('contact'), 
    icon: QuestionMarkCircleIcon
  },
  
]

//Full size navbar content
const resources = [
  // {
  //   name: 'Pridruži se',
  //   description: 'Postanite član naše biblioteke',
  //   href: '#',
  //   icon: PencilIcon,
  // },
  {
    name: 'Zbornik radova HMBiH',
    description: 'Pogledajte online sadržaj biblioteke',
    href: route('publications.list'),
    icon: BookOpenIcon,
  },
  {
    name: 'FAQ',
    description: 'Odgovori na često postavljena pitanja',
    href: route('faq'),
    icon: LightBulbIcon,
  },
  { 
    name: 'Pošalji upit', 
    description: 'Postavite nam pitanje', 
    href: route('contact'), 
    icon: QuestionMarkCircleIcon
  },
  
  
]

//Most recent news
const recentPosts = ref([]);
const load = async() =>{
  try{
    let data = await fetch(route("news.latest"))
    if (!data.ok){
      throw Error('News data not available')
    }
    recentPosts.value = await data.json()
  }
  catch(err){
    console.log(err.message)
  }
}
load()


//Show when user is logged in
const admin = [
  {
    name: 'Kontrolna ploča',
    href: route('dashboard'),
    icon: PencilSquareIcon,
  },
  {
    name: 'Postavke profila',
    href: route('profile.edit'),
    icon: UserIcon,
  },
  {
    name: 'Odjavi se',
    href: route('logout'),
    method: 'POST',
    type: 'button',
    as: 'button',
    icon: ArrowLeftOnRectangleIcon,
  },
];
</script>

<style>

</style>