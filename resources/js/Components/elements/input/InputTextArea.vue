<script setup>
import { toRef, watch } from "vue";

const props = defineProps({
    inputValue: String,
});
const emits = defineEmits(["update:inputValue"]);
const inputValue = toRef(() => props.inputValue);
const updateEventValue = (event) => {
    emits("update:inputValue", event.target.value);
};
</script>

<template>
    <textarea
        class="bg-primary-700 rounded-lg p-4 outline-none h-[150px] resize-none"
        @input="updateEventValue"
        :value="inputValue"
    ></textarea>
</template>
