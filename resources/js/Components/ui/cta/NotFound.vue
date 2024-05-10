<script setup>
const { caption } = defineProps({
    caption: String,
    require: true
})
</script>

<template>
    <section class="p-14">
        <slot name="header" />
        <h2 class="text-4xl font-semibold text-center">{{ caption }}</h2>
    </section>
</template>
