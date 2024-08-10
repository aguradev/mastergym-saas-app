<script setup>
import DashboardTenantLayout from "@layouts/DashboardTenantLayout.vue";
import DynamicSectionContent from "@components/ui/dynamicDetailContent/Index.vue";
import Badge from "primevue/badge";

import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import FormatCurrency from "@lib/Currency";

const page = usePage();
const membershipDetailData = computed(() => page.props.membershipPlan);
console.log(membershipDetailData.value);
</script>

<template>
    <DashboardTenantLayout>
        <section class="py-6 px-8 bg-primary-800">
            <h2 class="text-xl font-semibold mb-6">
                {{ membershipDetailData.title }}
            </h2>

            <div class="grid grid-cols-[.5fr_1fr] items-start">
                <div>
                    <DynamicSectionContent
                        label="title"
                        :caption="membershipDetailData.title"
                    />
                    <DynamicSectionContent
                        label="Package"
                        :caption="membershipDetailData.period_type"
                    />
                    <DynamicSectionContent
                        label="Amount"
                        :caption="FormatCurrency(membershipDetailData.amount)"
                    />
                    <div class="mb-8">
                        <h4 class="mb-3 text-base font-semibold capitalize">
                            Status
                        </h4>
                        <Badge
                            :value="membershipDetailData.status"
                            :severity="
                                membershipDetailData.status === 'ACTIVE'
                                    ? 'success'
                                    : 'danger'
                            "
                            class="w-[15%]"
                        />
                    </div>
                </div>

                <div>
                    <h4 class="mb-6 text-base font-semibold capitalize">
                        Membership features
                    </h4>
                    <ul class="flex flex-col flex-wrap gap-4">
                        <li
                            v-for="feature in membershipDetailData.membership_features"
                            class="text-sm"
                        >
                            {{ feature.title }}
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </DashboardTenantLayout>
</template>
