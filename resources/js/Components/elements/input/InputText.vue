<script setup>
import InputText from "primevue/inputtext";
import { isReadonly, toRefs } from "vue";
const emit = defineEmits(["update:inputValue", "inputRef"]);

const props = defineProps({
    inputValue: String,
    inputType: {
        type: String,
        default: "text",
    },
    inputId: String,
    inputPlaceholder: String,
    inputName: String,
    isReadonly: {
        type: Boolean,
        default: false,
    },
});

const { inputValue, inputId, inputType, inputPlaceholder, inputName, invalid } =
    toRefs(props);
</script>

<template>
    <InputText
        :value="inputValue"
        :id="inputId"
        :type="inputType"
        :placeholder="inputPlaceholder"
        :name="inputName"
        :readonly="props.isReadonly"
        @input="(event) => emit('update:inputValue', event.target.value)"
        :pt="{
            root: ({ props, context, parent }) => {
                return {
                    class: [
                        'bg-primary-700 rounded-lg py-3 px-4 w-full',
                        {
                            'focus:outline-none': !context.disabled,
                        },
                        // Invalid State
                        {
                            'border border-red-500 dark:border-red-400':
                                props.invalid,
                        },
                    ],
                };
            },
        }"
        :invalid="invalid"
    />
</template>
