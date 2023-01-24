<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

const form = useForm({
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
  keyword: "",
  terms: false,
});

const submit = () => {
  form.post(route("register"), {
    onFinish: () => form.reset("password", "password_confirmation"),
  });
};
</script>

<template>
  <div class="min-h-screen flex flex-col">
    <GuestLayout class="flex-1" id="guestLayout">
      <Head title="Registruj se" />
      <div
        class="
          flex flex-col flex-1
          sm:justify-center
          items-center
          py-6
          mb-12
          sm:pt-0
          bg-gray-100
        "
      >
        <Link href="/">
          <ApplicationLogo class="w-auto h-56 fill-current text-gray-500" />
        </Link>
        <div
          class="
            w-full
            sm:max-w-md
            mt-6
            px-6
            py-4
            bg-white
            shadow-md
            overflow-hidden
            sm:rounded-lg
          "
        >
          <form @submit.prevent="submit">
            <div>
              <InputLabel for="name" value="Ime" />

              <TextInput
                id="name"
                type="text"
                class="mt-1 block w-full"
                v-model="form.name"
                required
                autofocus
                autocomplete="name"
              />

              <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
              <InputLabel for="email" value="Email" />

              <TextInput
                id="email"
                type="email"
                class="mt-1 block w-full"
                v-model="form.email"
                required
                autocomplete="username"
              />

              <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
              <InputLabel for="password" value="Lozinka" />

              <TextInput
                id="password"
                type="password"
                class="mt-1 block w-full"
                v-model="form.password"
                required
                autocomplete="new-password"
              />

              <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
              <InputLabel for="password_confirmation" value="Potvrda lozinke" />

              <TextInput
                id="password_confirmation"
                type="password"
                class="mt-1 block w-full"
                v-model="form.password_confirmation"
                required
                autocomplete="new-password"
              />

              <InputError
                class="mt-2"
                :message="form.errors.password_confirmation"
              />
            </div>

            <div class="mt-4">
              <InputLabel for="keyword" value="Ključna riječ" />

              <TextInput
                id="keyword"
                type="text"
                class="mt-1 block w-full"
                v-model="form.keyword"
                required
                autofocus
                autocomplete="keyword"
              />

              <InputError class="mt-2" :message="form.errors.keyword" />
            </div>

            <div class="flex items-center justify-end mt-4">
              <Link
                :href="route('login')"
                class="
                  underline
                  text-sm text-gray-600
                  hover:text-gray-900
                  rounded-md
                  focus:outline-none
                  focus:ring-2
                  focus:ring-offset-2
                  focus:ring-indigo-500
                "
              >
                Već posjedujete račun?
              </Link>

              <PrimaryButton
                class="ml-4"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
              >
                Registruj se
              </PrimaryButton>
            </div>
          </form>
        </div>
      </div>
    </GuestLayout>
  </div>
</template>
