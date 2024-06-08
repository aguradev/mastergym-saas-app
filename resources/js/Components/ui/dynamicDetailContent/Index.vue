<script setup>
import { toRefs } from 'vue';

const props = defineProps({
    label: String,
    caption: String
})

const { label, caption } = toRefs(props)

</script>
<template>
    <div class="mb-8">
        <h4 class="mb-3 text-base font-semibold capitalize">{{ label }}</h4>
        <p class="text-base">{{ caption }}</p>
    </div>
</template>
