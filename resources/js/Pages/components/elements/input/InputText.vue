<script setup>
import InputText from 'primevue/inputtext';
import { ref, toRef, toRefs, watch } from 'vue';
const emit = defineEmits(["update:inputValue", "inputRef"]);

const props = defineProps({
    inputValue: String,
    inputType: String,
    inputId: String,
    inputPlaceholder: String,
    inputName: String,
})

const {
    inputValue,
    inputId,
    inputType,
    inputPlaceholder,
    inputName,
    invalid
} = props;

const refVal = toRef(inputValue)

</script>

<template>
    <InputText :value="refVal" v-model="refVal" :id="inputId" :type="inputType" :placeholder="inputPlaceholder"
        :name="inputName" @input="(event) => emit('update:inputValue', event.target.value)" :pt="{
            root: ({ props, context, parent }) => {
                return {
                    class: [
                        'bg-primary-700 rounded-lg py-3 px-4 w-full',
                        {
                            'focus:outline-none': !context.disabled
                        },
                        // Invalid State
                        { 'border border-red-500 dark:border-red-400': props.invalid },
                    ]
                }
            }
        }" :invalid="invalid" />
</template>
