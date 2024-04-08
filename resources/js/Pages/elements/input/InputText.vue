<script setup>

import InputText from 'primevue/inputtext';
import { toRefs } from 'vue';

const emit = defineEmits(["update:inputValue", "inputRef"]);

const props = defineProps({
    inputValue: String,
    inputType: String,
    inputId: String,
    inputPlaceholder: String,
})

const {
    inputValue,
    inputId,
    inputType,
    inputPlaceholder,
} = toRefs(props);

</script>

<template>
    <InputText v-model="inputValue" :id="inputId" :type="inputType" :placeholder="inputPlaceholder"
        @input="(event) => emit('update:inputValue', event.target.value)" :pt="{
        root: ({ props, context, parent }) => {
            return {
                class: [
                    'bg-primary-700 rounded-lg py-3 px-4',
                    {
                        'focus:outline-none focus:ring focus:ring-primary-500': !context.disabled
                    },
                ]
            }
        }
    }" />
</template>
