<script setup>
const emits = defineEmits(["update:inputValue"]);
const updateEventValue = (event) => {
    emits("update:inputValue", event.target.value);
};
</script>

<template>
    <textarea
        class="bg-primary-700 rounded-lg p-4 outline-none h-[150px] resize-none"
        @input="updateEventValue"
    ></textarea>
</template>
