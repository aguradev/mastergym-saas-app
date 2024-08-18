<script setup>
import DashboardTenantLayout from "@layouts/DashboardTenantLayout.vue";
import DynamicSectionContent from "@components/ui/dynamicDetailContent/Index.vue";
import Badge from "primevue/badge";

import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import FormatCurrency from "@lib/Currency";
import DataTable from "primevue/datatable";
import Column from "primevue/column";

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
        <section v-if="membershipDetailData.member_trainees.length > 0">
            <DataTable
                :value="membershipDetailData.member_trainees"
                :pt="{
                    bodyrow:
                        'bg-transparent last:border-none border-b border-primary-700 odd:bg-primary-800',
                    column: {
                        headercell: 'py-6 px-12 border-b border-primary-600',
                        headercontent:
                            'text-left font-[300] tracking-wide text-white/50',
                        bodycell: 'px-12 py-6 text-base',
                    },
                }"
            >
                <Column header="User">
                    <template #body="slotProps">
                        <div class="flex items-center gap-x-4">
                            <img
                                :src="slotProps.data.user.profile_image"
                                class="rounded-full size-14"
                            />
                            <span>{{ slotProps.data.user.full_name }}</span>
                        </div>
                    </template>
                </Column>
                <Column header="Start date">
                    <template #body="slotProps">
                        <span>{{
                            slotProps.data.start_date_format ?? "-"
                        }}</span>
                    </template>
                </Column>
                <Column header="Expired date">
                    <template #body="slotProps">
                        <span>{{
                            slotProps.data.expired_date_format ?? "-"
                        }}</span>
                    </template>
                </Column>
                <Column header="Membership status">
                    <template #body="slotProps">
                        <Badge
                            :value="slotProps.data.membership_status"
                            :severity="
                                slotProps.data.membership_status === 'ACTIVE'
                                    ? 'success'
                                    : 'danger'
                            "
                            class="w-[20%]"
                        />
                    </template>
                </Column>
            </DataTable>
        </section>
    </DashboardTenantLayout>
</template>
