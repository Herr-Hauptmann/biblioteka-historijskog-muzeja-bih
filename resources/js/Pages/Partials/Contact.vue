<script setup>

</script>

<template>
    <div class="container mx-auto px-6">
        <div class="grid md:grid-cols-2">
            <div class="flex flex-col justify-center">
                <div class="mx-auto max-w-2xl text-center">
                    <img :src="$page.props.images.logo" class="h-56 mx-auto">
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Kontaktirajte nas</h2>
                    <p class="mt-2 text-lg leading-8 text-gray-600">Naš tim se trudi odgovoriti na svaki upit u što kraćem vremenskom roku!</p>
                    <div class="grid grid-cols-12 mt-6">
                        <div class="mt-2 flex flex-col justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
                            </svg>
                        </div>
                        <div class="col-span-11 mt-4">
                            <p class="text-left pl-4">Zmaja od Bosne 5</p>
                            <p class="text-left pl-4">71 000 Sarajevo</p>
                            <p class="text-left pl-4">Bosna i Hercegovina</p>
                        </div>
                        <div class="mt-2 flex flex-col justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                            </svg>
                        </div>
                        <div class="col-span-11 mt-4">
                            <p class="text-left pl-4">+387 33 226 098</p>
                        </div>
                        <div class="mt-2 flex flex-col justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                        </div>
                        <div class="col-span-11 mt-4">
                            <p class="text-left pl-4">histmuz@bih.net.ba</p>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <form action="#" method="POST" class="mx-auto mt-16 max-w-xl sm:mt-20">
                    <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                        <div>
                            <label for="first-name" class="block text-sm font-semibold leading-6 text-gray-900">Ime</label>
                            <div class="mt-2.5">
                                <input type="text" name="first-name" id="first-name" autocomplete="given-name"
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            </div>
                        </div>
                        <div>
                            <label for="last-name" class="block text-sm font-semibold leading-6 text-gray-900">Prezime</label>
                            <div class="mt-2.5">
                                <input type="text" name="last-name" id="last-name" autocomplete="family-name"
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="company" class="block text-sm font-semibold leading-6 text-gray-900">Institucija</label>
                            <div class="mt-2.5">
                                <input type="text" name="company" id="company" autocomplete="organization"
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="email" class="block text-sm font-semibold leading-6 text-gray-900">Email adresa</label>
                            <div class="mt-2.5">
                                <input type="email" name="email" id="email" autocomplete="email"
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="phone-number" class="block text-sm font-semibold leading-6 text-gray-900">Broj telefona</label>
                            <div class="relative mt-2.5">
                                <input type="tel" name="phone-number" id="phone-number" autocomplete="tel"
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="message" class="block text-sm font-semibold leading-6 text-gray-900">Sadržaj poruke</label>
                            <div class="mt-2.5">
                                <textarea name="message" id="message" rows="4"
                                    class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            </div>
                        </div>
                    </div>
                    <div class="mt-10">
                        <button type="submit"
                            class="block w-full rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Pošalji poruku</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<style scoped></style>