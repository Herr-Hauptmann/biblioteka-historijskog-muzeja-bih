<script setup>
import Navigation from "@/Components/Navigation.vue";
import { usePage } from '@inertiajs/inertia-vue3' 
import { ref, watch } from 'vue'
import {
  TransitionRoot,
  TransitionChild,
  Dialog,
  DialogPanel,
  DialogTitle,
} from '@headlessui/vue'

const isOpen = ref(false)

function closeModal() {
  isOpen.value = false
}

watch(() => usePage().props.value.flash.message , (newValue, oldValue) => {
  if (newValue != null)
    isOpen.value = true
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
            <TransitionRoot appear :show="isOpen" as="template">
                <Dialog as="div" @close="closeModal" class="relative z-10">
                  <TransitionChild
                    as="template"
                    enter="duration-300 ease-out"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="duration-200 ease-in"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                  >
                    <div class="fixed inset-0 bg-black bg-opacity-25" />
                  </TransitionChild>
            
                  <div class="fixed inset-0 overflow-y-auto">
                    <div
                      class="flex min-h-full items-center justify-center p-4 text-center"
                    >
                      <TransitionChild
                        as="template"
                        enter="duration-300 ease-out"
                        enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100"
                        leave="duration-200 ease-in"
                        leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95"
                      >
                        <DialogPanel
                          class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
                        >
                          <DialogTitle
                            as="h3"
                            class="text-lg font-medium leading-6 text-gray-900"
                          >
                          {{ $page.props.flash.message }} 
                          </DialogTitle>            
                          <div class="mt-4">
                            <button
                              type="button"
                              class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                              @click="closeModal"
                            >
                              Ok!
                            </button>
                          </div>
                        </DialogPanel>
                      </TransitionChild>
                    </div>
                  </div>
                </Dialog>
              </TransitionRoot>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
