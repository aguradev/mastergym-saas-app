<script setup>
import { ref, computed } from 'vue'

const data = defineProps({
    name: String,
    image: String,
})

let imgUrl = ref(`/public/storage/${data.image}?t=${Date.now()}`);

if (data.image.includes("tenant")) {
    imgUrl = `/public/storage/${data.image}?t=${Date.now()}`;
} else {
    imgUrl = `${data.image}?t=${Date.now()}`;
}

const images = computed(() => {
    return new URL(`${imgUrl}`, import.meta.url).href
})
</script>

<template>
    <div id="box"
        class="bg-slate-200 drop-shadow-xl rounded-md w-parent px-10 py-10 h-parent mb-10 flex flex-col font-bold justify-center items-center">
        <img :src="images" class="h-[170px] mb-6" :alt="data.name + ' img'">
        <p class="text-xl capitalize">{{ data.name }}</p>
    </div>
</template>