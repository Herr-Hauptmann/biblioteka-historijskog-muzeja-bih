<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import Navbar from '../../Shared/Navbar.vue'

defineProps({
    status: String,
    logo_url: String,
    small_logo_url: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
     <div class="min-h-screen flex flex-col">
        <Navbar id="navbar" :logo_url="small_logo_url"/>
        <GuestLayout class="flex-1 pb-12" id="guestLayout" :logo_url="logo_url">
            <Head title="Zaboravljena lozinka" />

            <div class="mb-4 text-sm text-gray-600">
                Zaboravili ste svoju lozinku? Nema problema. Samo unesite svoju e-mail adresu i poslat ćemo vam link za ponovno postavljanje lozinke koji će vam omogućiti da kreirate novu lozinku.
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
                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Pošalji link putem mejla
                    </PrimaryButton>
                </div>
            </form>
        </GuestLayout>
    </div>
</template>
