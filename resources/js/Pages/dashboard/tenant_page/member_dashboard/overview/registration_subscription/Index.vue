<script setup>
import { ref } from "vue";
import GetStartedContent from "./GetStartedContent.vue";
import PricingPlanContent from "./PricingPlanContent.vue";
import MemberRegistration from "./MemberRegistration.vue";
import { useMembershipRegisterStore } from "@stores/tenant_membership_register_store";
import FinishContent from "./FinishContent.vue";

const registrationStepMember = [
    "Get Started",
    "Pricing plan",
    "Checkout",
    "Finish",
];

const membershipRegistrationStores = useMembershipRegisterStore();

const stepComponent = ref([
    {
        component: GetStartedContent,
    },
    {
        component: PricingPlanContent,
    },
    {
        component: MemberRegistration,
    },
    {
        component: FinishContent,
    },
]);

const stepActive = ref(0);

const nextStepHandler = (position) => {
    stepActive.value = position;
};
</script>

<template>
    <div class="border bg-primary-800 border-surface-500 p-8 rounded-lg mb-8">
        <div
            class="flex justify-between relative after:absolute after:inset-x-5 after:top-[30%] after:block after:h-0.5 after:-translate-y-1/2 after:rounded-lg after:bg-surface-500"
        >
            <figure v-for="(step, i) in registrationStepMember">
                <figcaption class="flex flex-col items-center justify-center">
                    <div
                        :class="`${registrationStepMember[stepActive] === step ? 'bg-surface-500' : 'bg-primary-900 border border-surface-500'} size-12 z-10 rounded-lg mb-4 place-content-center`"
                    >
                        <span class="text-xl text-center block">
                            {{ i + 1 }}</span
                        >
                    </div>
                    <p>{{ step }}</p>
                </figcaption>
            </figure>
        </div>
    </div>
    <div class="border bg-primary-800 border-surface-500 p-8 rounded-lg">
        <component
            :is="stepComponent[stepActive].component"
            @nextStepEvent="nextStepHandler"
        />
    </div>
</template>
