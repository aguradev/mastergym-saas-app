<script setup>
import { toRefs, onMounted, onUnmounted, watch } from 'vue';

const props = defineProps({
    title: String,
    modalVisible: Boolean
})

const { title, modalVisible } = toRefs(props);
const emits = defineEmits(["closeModal"])


watch(() => modalVisible.value, (newVal, prevVal) => {
    if (!newVal) {
        document.body.classList.remove("overflow-hidden");
        return;
    }

    document.body.classList.add("overflow-hidden")
})

</script>

<template>
    <div class="fixed top-0 left-0 grid w-full h-full px-8 place-content-center bg-primary-900/70" v-if="modalVisible">
    </div>

    <transition name="scaleIn">
        <div class="p-8 border rounded-lg bg-primary-800 border-surface-500 z-[99] min-w-[400px] sm:min-w-[600px] md:min-w-[800px] absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"
            v-if="modalVisible">
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-2xl font-semibold">{{ title }}</h3>
                <button type="button" @click="$emit('closeModal')">x</button>
            </div>

            <slot />
        </div>
    </transition>

</template>

<style scoped>
.scaleIn-enter-active,
.scaleIn-leave-active {
    @apply duration-200;
}

.scaleIn-enter-from,
.scaleIn-leave-to {
    @apply scale-90 opacity-0;
}
</style>
