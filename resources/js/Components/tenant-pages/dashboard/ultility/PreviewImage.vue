<script setup>
import { computed, onMounted } from 'vue';

const prop = defineProps({
    img: String,
})

let bg = computed(() => {
    return new URL(`${prop.img}`, import.meta.url).href
})
</script>
<template>
    <div>
        <img :src="bg" alt="" class="w-[200px] mt-2 pb-10">
    </div>
</template>