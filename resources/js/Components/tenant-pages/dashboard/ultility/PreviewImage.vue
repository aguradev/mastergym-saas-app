<script setup>
import { computed, onMounted } from 'vue';

const prop = defineProps({
    img: String,
    title: String,
    number: Number
})

let bg = computed(() => {
    return new URL(`${prop.img}`, import.meta.url).href
})
</script>
<template>
    <div>
        <img :src="bg" alt="" class="w-[200px] mt-2">
    </div>
</template>