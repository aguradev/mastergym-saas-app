<script setup>
import { toRef } from "vue";

const props = defineProps({
    featureLists: {
        type: Array,
        default: [],
    },
});

const featureLists = toRef(() => props.featureLists);
</script>

<template>
    <ul class="flex flex-col mt-8 space-y-4">
        <li class="inline-flex items-center space-x-2">
            <i class="pi pi-check text-zinc-900"></i>
            <span class="text-base font-medium basic-text text-zinc-900">
                50 Maximum members</span
            >
        </li>
    </ul>
</template>
