<script setup>
const { label, labelFor } = defineProps({
    label: String,
    labelFor: String,
    note: String,
});
</script>

<template>
    <div class="flex flex-col mb-6">
        <label :for="labelFor" class="block mb-2 text-capitalize">{{
            label
        }}</label>
        <slot />
        <span v-if="note" class="text-sm block mt-2">{{ note }}</span>
    </div>
</template>
