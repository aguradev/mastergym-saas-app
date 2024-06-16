<script setup>
const { caption } = defineProps({
    caption: String
})
</script>

<template>
    <span class="block mt-1 text-sm text-danger-300">{{ caption }}</span>
</template>
