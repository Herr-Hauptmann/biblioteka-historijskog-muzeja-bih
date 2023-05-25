<script setup>
import { computed } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from '@headlessui/vue'

const props = defineProps({
    deleteInfo : Object
});

const deleteInfo = computed(() => props.deleteInfo);

function setIsOpen(value) {
    props.deleteInfo.isOpen = value
}

const form = useForm();
let destroy = function (id) {
    form.delete(route(props.deleteInfo.deleteRoute, id));
    setIsOpen(false);
}
</script>

<template>
    <!-- MODAL -->
    <TransitionRoot v-if="deleteInfo" appear :show="deleteInfo.isOpen" as="template">
        <Dialog as="div" @close="setIsOpen(false)" class="relative z-10">
            <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100"
                leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-black bg-opacity-25" />
            </TransitionChild>

            <div class="fixed inset-0 overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4 text-center">
                    <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100" leave="duration-200 ease-in" leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95">
                        <DialogPanel
                            class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all">
                            <DialogTitle as="h3" class="text-lg font-medium leading-6 text-gray-900">
                                Da li ste sigurni?
                            </DialogTitle>
                            <div class="mt-2">
                                <p class="text-sm text-gray-1200">
                                    Da li ste sigurni da želite obrisati {{deleteInfo.deleteMessage }}? Ova akcija je trajna i ne može se vratiti.
                                </p>
                            </div>

                            <div class="mt-4 flex justify-between">
                                <button type="button"
                                    class="inline-flex justify-center rounded-md border border-transparent bg-red-300 px-4 py-2 text-sm font-medium hover:text-white hover:bg-red-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-100 focus-visible:ring-offset-2"
                                    @click="destroy(deleteInfo.id)">
                                    Da, obriši
                                </button>
                                <button type="button"
                                    class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                                    @click="setIsOpen(false)">
                                    Odustani
                                </button>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>