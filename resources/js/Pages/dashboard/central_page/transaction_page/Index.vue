<script setup>
import { Head, usePage } from "@inertiajs/vue3";
import { useNavMainPlatform } from "@stores/navigation_menu_item";
import Badge from "primevue/badge";
import { storeToRefs } from "pinia";

import DashboardLayout from "@layouts/DashboardLayout.vue";
import Modal from "@components/ui/modal/Index.vue";
import { defineAsyncComponent, onMounted, ref, toRefs } from "vue";
import DataTable from "primevue/datatable";
import Column from "primevue/column";

const getNavMainPlatform = useNavMainPlatform();
const { navigationMenuItem, menuItemActive } = storeToRefs(getNavMainPlatform);

const { props } = usePage();
const { transactions } = toRefs(props);
console.table(transactions.value);
const { current_page, per_page, data } = transactions.value;
const modalTransactionDetailVisible = ref(false);
const transactionSelected = ref(null);

onMounted(() => {
    menuItemActive.value = navigationMenuItem.value[1]?.items[4];
});

const detailEventHandler = (id) => {
    modalTransactionDetailVisible.value = true;
    transactionSelected.value = id;
};

const closeModalTransactionDetail = () => {
    modalTransactionDetailVisible.value = false;
    transactionSelected.value = null;
};

const getNumberColumn = (current_page, per_page, index) => {
    return (current_page - 1) * per_page + (index + 1);
};

const LazyTransactionDetail = defineAsyncComponent({
    loader: () => import("./Detail.vue"),
});
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
    <Head>
        <title>Transactions</title>
    </Head>

    <DashboardLayout
        :menu-items="navigationMenuItem"
        :menu-item-active="menuItemActive"
        titleNav="Transaction"
    >
        <DataTable
            :value="data"
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
            <Column header="No">
                <template #body="slotProps">
                    {{
                        getNumberColumn(current_page, per_page, slotProps.index)
                    }}
                </template>
            </Column>
            <Column header="Full Name">
                <template #body="slotProps">{{
                    slotProps.data.full_name
                }}</template>
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
            title="Transaction Detail"
            :modal-visible="modalTransactionDetailVisible"
            @close-modal="closeModalTransactionDetail"
        >
            <Suspense>
                <LazyTransactionDetail :id="transactionSelected" />
                <template #fallback> Loading... </template>
            </Suspense>
        </Modal>
    </DashboardLayout>
</template>
