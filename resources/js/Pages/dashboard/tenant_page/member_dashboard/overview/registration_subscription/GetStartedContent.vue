<script setup>
import PrimaryButton from "@components/elements/button/PrimaryButton.vue";
const emits = defineEmits(["nextStepEvent"]);
const instructionsContent = [
    "Subscribe to Unlock Full Access: Hit the Next Step button below to choose your membership plan and get full access to all our facilities and classes.",
    "Set Your Goals: Whether it's weight loss, muscle gain, or general fitness, we're here to help you reach them.",
];
</script>

<template>
    <section>
        <div class="mb-8">
            <h2 class="text-2xl font-semibold mb-4">Welcome New Member</h2>
            <p>
                We're thrilled to have you as part of our fitness family! Ready
                to kickstart your journey to a healthier, stronger you? Let's
                get started!
            </p>
        </div>
        <h4 class="mb-4 text-lg font-semibold">
            Follow these steps to complete your membership:
        </h4>
        <ul class="list-decimal ml-4">
            <li
                v-for="(content, i) in instructionsContent"
                :key="i"
                class="mb-2"
            >
                {{ content }}
            </li>
        </ul>
        <PrimaryButton
            label="Get Started"
            type="button"
            class="!px-6 !py-4 ml-auto"
            @click-event="() => $emit('nextStepEvent', 1)"
        />
    </section>
</template>
