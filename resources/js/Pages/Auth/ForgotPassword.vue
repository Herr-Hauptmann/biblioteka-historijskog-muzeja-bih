<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, useForm } from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

defineProps({
  status: String,
});

const form = useForm({
  email: "",
});

const submit = () => {
  form.post(route("password.email"));
};
</script>

<template>
  <GuestLayout id="guestLayout">
    <Head title="Zaboravljena lozinka" />
    <div
      class="
        flex-1 flex flex-col 
        sm:justify-center
        items-center
        pt-6
        sm:pt-0
        bg-gray-100
      "
    >
      <ApplicationLogo class="w-auto h-56 fill-current text-gray-500" />
      <div
        class="
          w-full
          sm:max-w-md
          mt-6
          px-6
          py-4
          mb-12
          bg-white
          shadow-md
          overflow-hidden
          sm:rounded-lg
        "
      >
        <div class="mb-4 text-sm text-gray-600">
          Zaboravili ste svoju lozinku? Nema problema. Samo unesite svoju e-mail
          adresu i poslat ćemo vam link za ponovno postavljanje lozinke koji će
          vam omogućiti da kreirate novu lozinku.
        </div>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
          {{ status }}
        </div>

        <form @submit.prevent="submit">
          <div>
            <InputLabel for="email" value="Email" />

            <TextInput
              id="email"
              type="email"
              class="mt-1 block w-full"
              v-model="form.email"
              required
              autofocus
              autocomplete="username"
            />

            <InputError class="mt-2" :message="form.errors.email" />
          </div>

          <div class="flex items-center justify-end mt-4">
            <PrimaryButton
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            >
              Pošalji link putem mejla
            </PrimaryButton>
          </div>
        </form>
      </div>
    </div>
  </GuestLayout>
</template>
