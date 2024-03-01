<script setup>
const props = defineProps({
    vendor__name: String,
})

</script>

<template>
    <div>Hello world {{ props.vendor__name }}</div>
</template>
