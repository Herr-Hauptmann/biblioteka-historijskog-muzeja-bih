<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import Navbar from "../../Shared/Navbar.vue";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

defineProps({
  canResetPassword: Boolean,
  status: String,
});

const form = useForm({
  email: "",
  password: "",
  remember: false,
});

const submit = () => {
  form.post(route("login"), {
    onFinish: () => form.reset("password"),
  });
};
</script>

<template>
  <GuestLayout id="guestLayout">
    <Head title="Prijavi se" />
    <div
      class="
        flex flex-col flex-1
        sm:justify-center
        items-center
        pt-6
        sm:pt-0
        bg-gray-100
        min-h-max
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
          mb-12
          bg-white
          shadow-md
          overflow-hidden
          sm:rounded-lg
        "
      >


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

          <div class="mt-4">
            <InputLabel for="password" value="Lozinka" />

            <TextInput
              id="password"
              type="password"
              class="mt-1 block w-full"
              v-model="form.password"
              required
              autocomplete="current-password"
            />

            <InputError class="mt-2" :message="form.errors.password" />
          </div>

          <div class="block mt-4">
            <label class="flex items-center">
              <Checkbox name="remember" v-model:checked="form.remember" />
              <span class="ml-2 text-sm text-gray-600"
                >Zapamti moju prijavu</span
              >
            </label>
          </div>

          <div class="flex items-center justify-end mt-4">
            <Link
              v-if="canResetPassword"
              :href="route('password.request')"
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
              Zaboravili ste lozinku?
            </Link>

            <PrimaryButton
              class="ml-4"
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            >
              Uloguj se
            </PrimaryButton>
          </div>
        </form>
      </div>
    </div>
  </GuestLayout>
</template>