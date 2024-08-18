<script setup>
import DashboardTenantLayout from "@layouts/DashboardTenantLayout.vue";
import NotFound from "@components/ui/cta/NotFound.vue";
import Badge from "primevue/badge";
import Toast from "primevue/toast";
import Modal from "@components/ui/modal/Index.vue";
import TrainessDetail from "@pages/dashboard/tenant_page/trainess_page/TrainessDetail.vue";

import { useToast } from "primevue/usetoast";
import { router, usePage, Link } from "@inertiajs/vue3";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import { computed, toRef } from "vue";
import { route } from "ziggy-js";

const toast = useToast();
const page = usePage();

const membershipSubs = computed(() => page.props.membershipSubs);
const closeModalHandler = () => {
    router.visit(route("tenant-dashboard.member.member-subscription"), {
        replace: true,
    });
};
</script>

<template>
    <DashboardTenantLayout>
        <Toast />
        <section v-if="membershipSubs.member_trainees.length > 0">
            <DataTable
                :value="membershipSubs.member_trainees"
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
                <Column header="Invoice id">
                    <template #body="slotProps">
                        <span>#{{ slotProps.data.invoice_id }}</span>
                    </template>
                </Column>
                <Column header="Membership plan">
                    <template #body="slotProps">
                        <span>{{ slotProps.data.membership_plan.title }}</span>
                    </template>
                </Column>
                <Column header="Period type">
                    <template #body="slotProps">
                        <span>{{
                            slotProps.data.membership_plan.period_type
                        }}</span>
                    </template>
                </Column>
                <Column header="Expired date">
                    <template #body="slotProps">
                        <span>{{
                            slotProps.data.membership_expired_date ?? "-"
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
                            class="w-[40%]"
                        />
                    </template>
                </Column>
                <Column header="Action">
                    <template #body="slotProps">
                        <ul class="action_lists">
                            <li class="action_item">
                                <Link
                                    as="button"
                                    class="action_link"
                                    :href="
                                        route(
                                            'tenant-dashboard.member.member-subscription',
                                            {
                                                id: slotProps.data.id,
                                            },
                                        )
                                    "
                                    :only="[
                                        'memberTrainessDetail',
                                        'modalTraineeDetail',
                                    ]"
                                    :preserve-state="true"
                                >
                                    <i class="pi pi-eye"></i>
                                </Link>
                            </li>
                        </ul>
                    </template>
                </Column>
            </DataTable>

            <Modal
                title="Trainess detail"
                :modal-visible="page.props.modalTraineeDetail"
                @close-modal="closeModalHandler"
                class-box="md:min-w-[1200px]"
            >
                <TrainessDetail />
            </Modal>
        </section>
        <section v-else>
            <NotFound caption="Subscription is empty" />
        </section>
    </DashboardTenantLayout>
</template>
