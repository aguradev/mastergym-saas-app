<script setup>
const { label, labelFor } = defineProps({
    label: String,
    labelFor: String,
});
</script>

<template>
    <div class="flex flex-col mb-6">
        <label :for="labelFor" class="block mb-2 text-capitalize">{{
            label
        }}</label>
        <slot />
    </div>
</template>
