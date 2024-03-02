<script setup>
const props = defineProps({
    vendor__name: String,
})

import Button from 'primevue/button';

</script>

<template>
    <div>Hello world {{ props.vendor__name }}</div>
    <Button>Hello World</Button>
</template>
