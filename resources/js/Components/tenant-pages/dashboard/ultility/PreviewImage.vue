<script setup>
import { computed } from 'vue';

const prop = defineProps({
    img: String
})

let bg = computed(() => {
    return new URL(`${prop.img}`, import.meta.url).href
})
</script>
<template>
    <div>
        <p>Background Image Currently Used</p>
        <img :src="bg" alt="" class="w-[200px] mt-2">
    </div>
</template>