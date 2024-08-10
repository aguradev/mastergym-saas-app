<script setup>
import { Link } from "@inertiajs/vue3";
import { toRef } from "vue";
const props = defineProps({
    items: {
        type: Array,
        default: [],
    },
    visible: false,
});

const visible = toRef(() => props.visible);
</script>

<template>
    <div
        class="absolute top-[50px] right-3 p-3 min-w-[180px] bg-surface-600 rounded-lg z-50 overflow-hidden"
        v-if="visible"
    >
        <nav class="flex flex-col gap-4">
            <Link
                v-for="content in props.items"
                as="button"
                :href="content.url"
                :method="content.method"
                class="px-4 py-2 hover:bg-surface-700 rounded-lg text-left"
                >{{ content.label }}</Link
            >
        </nav>
    </div>
</template>
