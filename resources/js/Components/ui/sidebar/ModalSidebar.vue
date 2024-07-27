<script setup>
import { toRefs, watch } from "vue";

const props = defineProps({
    title: String,
    modalVisible: Boolean,
});

const { title, modalVisible } = toRefs(props);
const emits = defineEmits(["closeModal"]);

watch(
    () => modalVisible.value,
    (status) => {
        if (!status) {
            document.body.classList.remove("overflow-hidden");
            return;
        }

        document.body.classList.add("overflow-hidden");
    },
);
</script>

<template>
    <div
        class="fixed z-[99] top-0 left-0 grid w-full h-full px-8 place-content-center bg-primary-900/70"
        v-if="modalVisible"
        @click="$emit('closeModal')"
    ></div>

    <transition name="sidebar-slide">
        <div class="modal__sidebar" v-if="modalVisible">
            <header class="flex items-center justify-between mb-5">
                <h3 class="text-2xl font-semibold">{{ title }}</h3>
                <button type="button" @click="$emit('closeModal')">x</button>
            </header>

            <slot />
        </div>
    </transition>
</template>

<style scoped>
.modal__sidebar {
    @apply p-8 border-l bg-primary-800 border-surface-500 z-[99] min-h-screen fixed right-0 top-0 min-w-[600px];
}

.sidebar-slide-enter-active,
.sidebar-slide-leave-active {
    transition: 200ms ease;
}

.sidebar-slide-enter-from {
    transform: translateX(300px);
}

.sidebar-slide-leave-to {
    opacity: 0;
    transform: translateX(500px);
}
</style>
