<script setup>
import { computed, ref, toRefs } from "vue"

import serviceCard from "./ServiceCard.vue"
import { usePage } from '@inertiajs/vue3';

const page = usePage();

const { service } = toRefs(page.props)

const parsedService = computed(() => {
    try {
        return JSON.parse(service.value);
    } catch (e) {
        console.error("Error parsing service JSON: ", e);
        return null;
    }
})


</script>

<template>
    <div class="h-content flex-row justify-center bg-slate-500 text-white overflow-hidden">
        <div id="text" class="h-fit text-center pt-20">
            <p class="text-orange-400 text-5xl font-bold capitalize">{{ parsedService.title }}</p>
            <p class="text-white px-10 md:px-80 pt-5">{{ parsedService.text }}</p>
        </div>
        <div id="content"
            class="w-screen grid grid-rows-1 sm:grid-cols-1 md:grid-cols-2 xl:grid-cols-4 px-20 py-20 text-orange-500">
            <serviceCard v-for="(item, index) in parsedService.cards" :name="item.name" :image="item.image" />
        </div>
    </div>
</template>
