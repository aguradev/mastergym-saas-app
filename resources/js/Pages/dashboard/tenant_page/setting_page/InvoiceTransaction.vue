<script setup>
import { router, usePage } from "@inertiajs/vue3";
import SettingPage from "./SettingPage.vue";
import { computed } from "vue";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import FormatCurrency from "../../../../Lib/Currency";
import { route } from "ziggy-js";
import Modal from "@components/ui/modal/Index.vue";
import InvoiceDetail from "./InvoiceDetail.vue";

import Badge from "primevue/badge";
const page = usePage();
const tenantTransactions = computed(() => page.props.tenantTransactions);
const tenantInvoiceDetail = computed(() => page.props.tenantInvoiceDetail);
const detailEventHandler = (id) => {
    router.visit(
        route("tenant-dashboard.invoice-transaction", {
            id: id,
        }),
        {
            preserveState: true,
            only: ["tenantInvoiceDetail"],
        },
    );
};
const closeModalHandler = () => {
    router.visit(route("tenant-dashboard.invoice-transaction"), {
        preserveState: true,
        replace: true,
    });
};
</script>

<style scoped>
.action_lists {
    @apply flex gap-x-6 items-center;

    .action_link {
        @apply text-base bg-primary-700 p-3 rounded;

        &:hover {
            @apply bg-primary-600;
        }
    }
}
</style>

<template>
    <SettingPage>
        <DataTable
            :value="tenantTransactions.tenant_transaction"
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
            <Column header="Order ID">
                <template #body="slotProps">
                    <p class="text-nowrap">
                        {{ slotProps.data.order_id }}
                    </p>
                </template>
            </Column>
            <Column header="Name">
                <template #body="slotProps">
                    <span class="text-nowrap">{{
                        slotProps.data.full_name
                    }}</span>
                </template>
            </Column>
            <Column header="Email">
                <template #body="slotProps">{{
                    slotProps.data.email
                }}</template></Column
            >
            <Column header="Payment Type">
                <template #body="slotProps">{{
                    slotProps.data.payment_type
                }}</template></Column
            >
            <Column header="Status">
                <template #body="slotProps">
                    <Badge
                        :value="slotProps.data.status"
                        class="px-4 !text-white"
                        :severity="[
                            slotProps.data.status === 'PENDING'
                                ? 'info'
                                : slotProps.data.status === 'PAID'
                                  ? 'success'
                                  : 'danger',
                        ]"
                    />
                </template>
            </Column>
            <Column header="Period Type">
                <template #body="slotProps">
                    {{ slotProps.data.period_type }}
                </template>
            </Column>
            <Column header="Amount (total + tax)">
                <template #body="slotProps">
                    {{ FormatCurrency(slotProps.data.total) }}
                </template>
            </Column>
            <Column header="Actions">
                <template #body="slotProps">
                    <ul class="action_lists">
                        <li class="action_item">
                            <button
                                type="button"
                                class="action_link"
                                @click="
                                    () => detailEventHandler(slotProps.data.id)
                                "
                            >
                                <i class="pi pi-eye"></i>
                            </button>
                        </li>
                    </ul>
                </template>
            </Column>
        </DataTable>

        <Modal
            title="Invoice detail"
            :modal-visible="tenantInvoiceDetail"
            @close-modal="closeModalHandler"
        >
            <InvoiceDetail />
        </Modal>
    </SettingPage>
</template>
