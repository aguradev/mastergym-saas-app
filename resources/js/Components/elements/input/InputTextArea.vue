<script setup>
const emits = defineEmits(["update:inputValue"]);
</script>

<template>
    <textarea
        class="bg-primary-700 rounded-lg p-4 outline-none h-[150px] resize-none"
        @input="(event) => $emit('update:inputValue', event.target.value)"
    ></textarea>
</template>
