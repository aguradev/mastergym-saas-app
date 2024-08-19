<script setup>
    import { ref, computed } from 'vue';

    const data = defineProps({
        name: String,
        image: String,
    });

    let imgUrl = ref(data.image);
</script>

<template>
    <div
        id="box"
        class="bg-slate-200 drop-shadow-xl rounded-md w-parent px-10 py-10 h-parent mb-10 flex flex-col font-bold justify-center items-center"
    >
        <img
            :src="imgUrl"
            class="h-[170px] mb-6"
            :alt="data.name + ' img'"
        />
        <p class="text-xl capitalize">{{ data.name }}</p>
    </div>
</template>
