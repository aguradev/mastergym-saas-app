<script setup>
import Password from "primevue/password";
import { toRefs } from "vue";

const props = defineProps({
    inputValue: String,
    inputId: String,
    inputPlaceholder: String,
    toggleMask: Boolean,
});

const { inputId, inputPlaceholder, toggleMask } = toRefs(props);

const emits = defineEmits(["update:inputValue"]);
</script>

<template>
    <Password
        v-model="props.inputValue"
        :id="inputId"
        @input="(event) => emits('update:inputValue', event.target.value)"
        :placeholder="inputPlaceholder"
        name="password"
        :toggleMask="toggleMask"
        :feedback="false"
        :pt="{
            root: ['bg-transparent relative'],
            input: {
                root: ({ props, context, parent }) => ({
                    class: [
                        'bg-primary-700 w-full relative py-3 px-4 rounded-lg',
                        {
                            'focus:outline-none focus:ring focus:ring-primary-500':
                                !context.disabled,
                        },
                    ],
                }),
            },
        }"
    />
</template>
