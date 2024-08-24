<script setup>
import DashboardTenantLayout from "@layouts/DashboardTenantLayout.vue";
import { router, usePage } from "@inertiajs/vue3";
import { computed, ref, toRef } from "vue";
import { useMembershipRegisterStore } from "@stores/tenant_membership_register_store";
import { storeToRefs } from "pinia";
import MemberPricing from "@components/ui/pricing-card/MemberPricing.vue";

const tabLists = ["Monthly", "Half Yearly", "Yearly"];
const tabActive = ref(tabLists[0]);
const membershipRegistrationStores = useMembershipRegisterStore();
const { formRequestRegistration } = storeToRefs(membershipRegistrationStores);

const page = usePage();
const membershipPricings = computed(() => page.props.membershipPricings);

const tabClickPricingHandler = (position) => {
    tabActive.value = tabLists[position];
};

const planSelectorHandler = (id) => {
    formRequestRegistration.value.membershipPlanId = id;
};
</script>

<template>
    <DashboardTenantLayout>
        <section class="px-8 py-6">
            <h2 class="text-2xl font-semibold mb-6">Select Pricing plan</h2>
            <div class="mt-2">
                <div class="flex items-center space-x-2.5">
                    <div class="flex gap-x-4">
                        <button
                            type="button"
                            v-for="(tab, i) in tabLists"
                            :class="`${tabActive === tab ? `bg-surface-500` : `border border-surface-500`} px-6 py-4 rounded-lg font-semibold hover:bg-surface-500`"
                            :key="i"
                            @click="() => tabClickPricingHandler(i)"
                        >
                            {{ tab }}
                        </button>
                    </div>
                </div>

                <div
                    class="grid lg:grid-cols-3 mt-8 gap-4"
                    v-show="tabActive === 'Monthly'"
                >
                    <MemberPricing
                        :planPricings="membershipPricings['Monthly']"
                        @plan-select-event="planSelectorHandler"
                        :plan-selected-id="
                            formRequestRegistration.membershipPlanId
                        "
                    />
                </div>
                <div
                    class="grid lg:grid-cols-3 mt-8 gap-4"
                    v-show="tabActive === 'Half Yearly'"
                >
                    <MemberPricing
                        :planPricings="membershipPricings['Half Yearly']"
                        @plan-select-event="planSelectorHandler"
                        :plan-selected-id="
                            formRequestRegistration.membershipPlanId
                        "
                    />
                </div>
                <div
                    class="grid lg:grid-cols-3 mt-8 gap-4"
                    v-show="tabActive === 'Yearly'"
                >
                    <MemberPricing
                        :planPricings="membershipPricings['Yearly']"
                        @plan-select-event="planSelectorHandler"
                        :plan-selected-id="
                            formRequestRegistration.membershipPlanId
                        "
                    />
                </div>
            </div>
            <div class="flex justify-between gap-x-4">
                <PrimaryButton
                    v-if="formRequestRegistration.membershipPlanId !== null"
                    label="Next"
                    type="button"
                    class="!px-6 !py-4 ml-auto"
                    @click-event="pricingPlanHandler"
                />
            </div>
        </section>
    </DashboardTenantLayout>
</template>
