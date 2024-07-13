<script setup>
import PrimaryButton from "@components/elements/button/PrimaryButton.vue";

const { message } = defineProps({
    message: String,
});
</script>

<template>
    <div class="w-screen h-screen place-content-center">
        <div class="text-center mb-8">
            <h1 class="text-5xl font-semibold mb-8">{{ message }}</h1>
            <p>Please check your email for next instruction</p>
        </div>

        <PrimaryButton
            label="Back to home"
            classBtn="text-center block bg-surface-600 px-6 py-3 mx-auto rounded-lg"
        />
    </div>
</template>
