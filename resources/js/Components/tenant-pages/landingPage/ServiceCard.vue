<script setup>
import { ref, computed } from 'vue'

const data = defineProps({
    name: String,
    image: String,
})

const images = computed(() => {
    return new URL(`${data.image}`, import.meta.url).href
})
</script>

<template>
    <div id="box"
        class="bg-slate-200 drop-shadow-xl rounded-md w-[300px] h-[300px] mb-10 flex flex-col font-bold justify-center items-center">
        <img :src="images" class="h-[170px] mb-6" :alt="data.name + ' img'">
        <p class="text-xl capitalize">{{ data.name }}</p>
    </div>
</template>