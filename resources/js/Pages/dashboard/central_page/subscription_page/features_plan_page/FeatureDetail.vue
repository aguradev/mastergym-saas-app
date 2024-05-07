<script setup>
import { toRefs, onMounted, onUnmounted } from 'vue';

const props = defineProps({
    featureDataDetail: Object,
    modalVisible: Boolean
})

const { featureDataDetail, modalVisible } = toRefs(props);
const emits = defineEmits(["closeFeatureDetail"])

onMounted(() => {
    document.body.classList.add("overflow-hidden")
})

onUnmounted(() => {
    document.body.classList.remove("overflow-hidden")
})

</script>

<template>
    <div class="fixed top-0 left-0 w-full h-full grid place-content-center bg-primary-800/60 z-[99] px-8">
        <div class="p-8 border rounded-lg bg-primary-700 border-surface-500 min-w-[800px]">
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-2xl font-semibold">Feature Detail</h3>
                <button type="button" @click="$emit('closeFeatureDetail')">x</button>
            </div>
            <slot />
        </div>
    </div>
</template>
