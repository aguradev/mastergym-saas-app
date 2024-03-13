<script setup>

import InputText from 'primevue/inputtext';
import { watchEffect } from 'vue';

const emit = defineEmits(["update:inputValue"]);
const props = defineProps({
    inputValue: String,
    inputType: String,
    inputId: String,
    inputPlaceholder: String
})

</script>

<template>
    <InputText v-model="props.inputValue" :id="props.inputId" :type="props.inputType"
        :placeholder="props.inputPlaceholder" @input="(event) => emit('update:inputValue', event.target.value)" :pt="{
        root: [
            'bg-primary-700 rounded-lg py-3 px-4'
        ]
    }" />
</template>
