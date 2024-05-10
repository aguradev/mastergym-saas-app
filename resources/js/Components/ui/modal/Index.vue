<script setup>
import { toRefs, onMounted, onUnmounted } from 'vue';

const props = defineProps({
    title: String,
    modalVisible: Boolean
})

const { title, modalVisible } = toRefs(props);
const emits = defineEmits(["closeModal"])

onMounted(() => {
    document.body.classList.add("overflow-hidden");
})

onUnmounted(() => {
    document.body.classList.remove("overflow-hidden")
})

</script>

<template>
    <transition name="scaleIn">
        <div class="fixed top-0 left-0 w-full h-full grid place-content-center bg-primary-800/60 z-[99] px-8"
            v-if="modalVisible">
            <div class="p-8 border rounded-lg bg-primary-700 border-surface-500 w-[400px] lg:min-w-[800px]">
                <div class="flex items-center justify-between mb-5">
                    <h3 class="text-2xl font-semibold">{{ title }}</h3>
                    <button type="button" @click="$emit('closeModal')">x</button>
                </div>

                <slot />
            </div>
        </div>
    </transition>
</template>

<style scoped>
.scaleIn-enter-active,
.scaleIn-leave-active {
    @apply duration-500;
}

.scaleIn-enter-from,
.scaleIn-leave-to {
    @apply scale-90 opacity-0;
}
</style>
