<script setup>
import { ref, computed, watch } from 'vue'
import {
  Combobox,
  ComboboxInput,
  ComboboxButton,
  ComboboxOptions,
  ComboboxOption,
  TransitionRoot,
} from '@headlessui/vue'
import { CheckIcon, ChevronUpDownIcon } from '@heroicons/vue/20/solid'

const props = defineProps({
    content: Array,
    what: String,
})

let selected = ref(null)
let query = ref('')

const queryItem = computed(() => {
    return query.value === '' ? null : { id: null, name: query.value }
  })

let filteredPeople = computed(() =>
  query.value.length <= 2
    ? []
    : props.content.filter((item) =>
        item.name
          .toLowerCase()
          .replace(/\s+/g, '')
          .includes(query.value.toLowerCase().replace(/\s+/g, ''))
      )
)

const emit = defineEmits(['itemSelected'])

watch(selected, ()=>{
  emit('itemSelected', selected.value)
})

let addBackground = function(){
  document.getElementById("create").parentElement.classList.add('hover');
}
let removeBackground = function(){
  document.getElementById("create").parentElement.classList.remove('hover');
}
</script>

<template>
    <Combobox v-model="selected" nullable>
        <div class="relative mt-1">
          <div
            class="relative w-full cursor-default overflow-hidden rounded-lg bg-white text-left shadow-md focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-teal-300 sm:text-sm"
          >
            <ComboboxInput
              class="w-full border-none py-2 pl-3 pr-10 text-sm leading-5 text-gray-900 focus:ring-0"
              :displayValue="(item) => item?.name"
              @change="query = $event.target.value"
            />
            <ComboboxButton
              class="absolute inset-y-0 right-0 flex items-center pr-2"
            >
              <ChevronUpDownIcon
                class="h-5 w-5 text-gray-400"
                aria-hidden="true"
              />
            </ComboboxButton>
          </div>
          <TransitionRoot
            leave="transition ease-in duration-100"
            leaveFrom="opacity-100"
            leaveTo="opacity-0"
            @after-leave="query = ''"
          >
            <ComboboxOptions
              class="absolute z-20 mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
            >
              <div
                v-if="query !== ''"
                class="relative cursor-default select-none py-2 px-4 text-gray-700 rounded-none"
              >
              <ComboboxOption v-if="queryItem" :value="queryItem" id="create" @mouseover="addBackground" @mouseleave="removeBackground">
                Kreiraj {{ what }}: "{{ query }}"
              </ComboboxOption>
            </div>
            
              <ComboboxOption
                v-for="item in filteredPeople"
                as="template"
                :key="item.id"
                :value="item"
                v-slot="{ selected, active }"
              >
                <li
                  class="relative cursor-default select-none py-2 px-4"
                  :class="{
                    'bg-teal-600 text-white': active,
                    'text-gray-900': !active,
                  }"
                >
                  <span
                    class="block truncate"
                    :class="{ 'font-medium': selected, 'font-normal': !selected }"
                  >
                    {{ item.name }}
                  </span>
                  <span
                    v-if="selected"
                    class="absolute inset-y-0 left-0 flex items-center pl-3"
                    :class="{ 'text-white': active, 'text-teal-600': !active }"
                  >
                    <CheckIcon class="h-5 w-5" aria-hidden="true" />
                  </span>
                </li>
              </ComboboxOption>
            </ComboboxOptions>
          </TransitionRoot>
        </div>
      </Combobox>
</template>

<style scoped>
.hover{
  background-color: #047481;
  color: white;
  border-radius: 10px;
}
</style>