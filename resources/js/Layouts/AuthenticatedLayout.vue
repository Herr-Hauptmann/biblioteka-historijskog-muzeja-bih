<script setup>
import Navigation from "@/Components/Navigation.vue";
import { usePage } from '@inertiajs/inertia-vue3' 
import { ref, watch } from 'vue'
import SuccessAlert from "@/Components/SuccessAlert.vue"

const isOpen = ref(false)

function closeModal() {
  isOpen.value = false
}

watch(() => usePage().props.value.flash.message , (newValue, oldValue) => {
  if (newValue != null)
    isOpen.value = true
  setTimeout(()=>isOpen.value = false, 2000)
})
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <Navigation />

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 mt-3">
                    <slot name="header" />
                </div>
            </header>

            <!-- Session messages and errors -->
            
            <!-- Page Content -->
            <main>
              <SuccessAlert v-if="isOpen" @click="closeModal" :message="$page.props.flash.message" />
                <slot />
            </main>
        </div>
    </div>
</template>
