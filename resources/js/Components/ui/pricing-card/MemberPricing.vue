<script setup>
import PrimaryButton from "@components/elements/button/PrimaryButton.vue";
import FormatCurrency from "../../../Lib/Currency";

const props = defineProps({
    planPricings: Array,
    planSelectedId: String,
});

const emits = defineEmits(["planSelectEvent"]);
</script>

<template>
    <div
        class="divide-y rounded-2xl border border-surface-500 shadow-sm"
        v-for="plan in props.planPricings"
        :key="plan.id"
    >
        <div class="p-6 sm:px-8">
            <h2 class="text-xl font-medium text-white">
                {{ plan.title }}
                <span class="sr-only">Plan</span>
            </h2>

            <p class="mt-2 sm:mt-4">
                <strong class="text-3xl font-bold text-white sm:text-4xl">
                    {{ FormatCurrency(plan.amount) }}
                </strong>
            </p>

            <ul class="flex flex-col mt-8 space-y-4">
                <li
                    class="inline-flex items-center space-x-2"
                    v-for="(feature, i) in plan.membership_features"
                    :key="feature.id"
                >
                    <i class="pi pi-check text-white"></i>
                    <span class="text-base font-medium basic-text text-white">
                        {{ feature.title }}</span
                    >
                </li>
            </ul>

            <PrimaryButton
                :label="plan.id === planSelectedId ? 'Selected' : 'Select plan'"
                :class="`${plan.id === planSelectedId ? '!bg-transparent border border-surface-500' : '!bg-surface-500'} block w-full mt-8`"
                @click-event="() => $emit('planSelectEvent', plan.id)"
            />
        </div>
    </div>
</template>
