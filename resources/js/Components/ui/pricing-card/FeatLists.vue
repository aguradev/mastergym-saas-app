<script setup>
import { toRef } from "vue";

const props = defineProps({
    featureLists: {
        type: Array,
        default: [],
    },
    listClass: String,
});

const featureLists = toRef(() => props.featureLists);
</script>

<template>
    <ul class="flex flex-col mt-8 space-y-4">
        <li
            class="inline-flex items-center space-x-2"
            v-for="(feature, i) in featureLists"
            :key="feature.id"
        >
            <i class="pi pi-check text-zinc-900" :class="listClass"></i>
            <span
                class="text-base font-medium basic-text text-zinc-900"
                :class="listClass"
            >
                {{ feature.name }}</span
            >
        </li>
    </ul>
</template>
