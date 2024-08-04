<script setup>
import { Link, router, usePage } from "@inertiajs/vue3";
import MembershipLayout from "@pages/dashboard/tenant_page/membership_page/MembershipLayout.vue";
import Modal from "@components/ui/modal/Index.vue";
import { route } from "ziggy-js";
import MembershipPlanForm from "./MembershipPlanForm.vue";
import { computed } from "vue";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import FormatCurrency from "../../../../../Lib/Currency";
import Badge from "primevue/badge";
import ActionLists from "@components/elements/ulLists/ActionLists.vue";

const page = usePage();
const membershipPlans = computed(() => page.props.membershipPlans);

const closeModalhandler = () => {
    router.visit(route("tenant-dashboard.membership.plan-page"), {
        replace: true,
    });
};

const membershipDetailAction = (id) => {
    return router.visit(
        route("tenant-dashboard.membership.detail", {
            membershipPlan: id,
        }),
        {
            replace: true,
            method: "get",
        },
    );
};

const editActionHandler = (id) => {
    router.visit(
        route("tenant-dashboard.membership.plan-page", {
            id: id,
        }),
        {
            only: [
                "modalEdit",
                "getMembershipFeaturesActive",
                "membershipPlanEditData",
            ],
            replace: true,
        },
    );
};
</script>

<template>
    <MembershipLayout>
        <header class="px-6 py-6 w-full">
            <Link
                preserve-state
                as="button"
                :only="['modalCreate', 'getMembershipFeaturesActive']"
                class="bg-surface-600 px-4 py-3 rounded-lg flex items-center gap-x-2"
            >
                <i class="pi pi-plus"></i>
                <span>Create Plan</span>
            </Link>
        </header>

        <div v-if="membershipPlans.data.length > 0">
            <DataTable
                :value="membershipPlans.data"
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
                <Column header="Title">
                    <template #body="slotProps">
                        <span>{{ slotProps.data.title }}</span>
                    </template>
                </Column>
                <Column header="Package">
                    <template #body="slotProps">
                        <span>{{ slotProps.data.period_type }}</span>
                    </template>
                </Column>
                <Column header="Amount">
                    <template #body="slotProps">
                        <span>{{ FormatCurrency(slotProps.data.amount) }}</span>
                    </template>
                </Column>
                <Column header="Feature">
                    <template #body="slotProps">
                        <div
                            v-if="slotProps.data.membership_features.length > 0"
                        >
                            <ul class="flex flex-col gap-2">
                                <li
                                    v-for="feature in slotProps.data
                                        .membership_features"
                                >
                                    {{ feature.title }}
                                </li>
                            </ul>
                        </div>
                        <span v-else>-</span>
                    </template>
                </Column>
                <Column header="Status">
                    <template #body="slotProps">
                        <Badge
                            :value="slotProps.data.status"
                            :severity="
                                slotProps.data.status === 'ACTIVE'
                                    ? 'success'
                                    : 'danger'
                            "
                            class="w-[60%]"
                        />
                    </template>
                </Column>
                <Column header="Action">
                    <template #body="slotProps">
                        <ActionLists
                            @detailEvent="
                                () => membershipDetailAction(slotProps.data.id)
                            "
                            @editEvent="
                                () => editActionHandler(slotProps.data.id)
                            "
                        />
                    </template>
                </Column>
            </DataTable>
        </div>

        <Modal
            title="Create membership plan"
            :modal-visible="page.props.modalCreate"
            @close-modal="closeModalhandler"
        >
            <MembershipPlanForm />
        </Modal>
        <Modal
            title="Edit membership plan"
            :modal-visible="page.props.modalEdit"
            @close-modal="closeModalhandler"
        >
            <MembershipPlanForm mode="edit" />
        </Modal>
    </MembershipLayout>
</template>
