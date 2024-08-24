<script setup>
import DashboardTenantLayout from "@layouts/DashboardTenantLayout.vue";
import SelectPricing from "./SelectPricing.vue";
import { onUnmounted, ref } from "vue";
import Checkout from "./Checkout.vue";
import FinishContent from "../overview/registration_subscription/FinishContent.vue";
import { useMembershipRegisterStore } from "@stores/tenant_membership_register_store";
import { storeToRefs } from "pinia";

const componentLists = [SelectPricing, Checkout, FinishContent];
const tabActive = ref(0);
const membershipRegistrationStores = useMembershipRegisterStore();
const { formRequestRegistration } = storeToRefs(membershipRegistrationStores);

const nextStepHandler = () => {
    tabActive.value += 1;
};

onUnmounted(() => {
    formRequestRegistration.value.membershipPlanId = null;
});
</script>

<template>
    <DashboardTenantLayout>
        <div class="px-8">
            <component
                :is="componentLists[tabActive]"
                @nextStepEvent="nextStepHandler"
            />
        </div>
    </DashboardTenantLayout>
</template>
