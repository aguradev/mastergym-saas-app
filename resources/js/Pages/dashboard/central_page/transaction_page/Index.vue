<script setup>
import { Head, router, usePage } from "@inertiajs/vue3";
import { route } from "ziggy-js";
import { useNavMainPlatform } from "@stores/navigation_menu_item";
import Badge from "primevue/badge";
import { storeToRefs } from "pinia";

import DashboardLayout from "@layouts/DashboardLayout.vue";
import Modal from "@components/ui/modal/Index.vue";
import { computed, defineAsyncComponent, onMounted, ref, toRef } from "vue";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import NotFound from "@components/ui/cta/NotFound.vue";
import TablePagination from "@components/elements/pagination/TablePagination.vue";
import FormatCurrency from "../../../../Lib/Currency";

const getNavMainPlatform = useNavMainPlatform();
const { navigationMenuItem, menuItemActive } = storeToRefs(getNavMainPlatform);

const page = usePage();
const transactions = toRef(() => page.props.transactions);

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

const LazyTransactionDetail = defineAsyncComponent({
    loader: () => import("./Detail.vue"),
});

function handlerPaginationFeature(page) {
    router.get(
        route("central-dashboard.transactions.lists"),
        {
            page: page,
        },
        {
            preserveScroll: true,
        },
    );
}
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
        <div v-if="transactions.data.length <= 0">
            <NotFound caption="No transaction data" />
        </div>
        <div v-else>
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
                <Column header="Date & Time">
                    <template #body="slotProps">
                        <p class="text-nowrap">
                            {{ slotProps.data.date_and_time }}
                        </p>
                    </template>
                </Column>
                <Column header="Name">
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
                                        () =>
                                            detailEventHandler(
                                                slotProps.data.id,
                                            )
                                    "
                                >
                                    <i class="pi pi-eye"></i>
                                </button>
                            </li>
                        </ul>
                    </template>
                </Column>
            </DataTable>

            <div class="mt-6">
                <TablePagination
                    :pagination="transactions"
                    @load-page="handlerPaginationFeature"
                />
            </div>

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
        </div>
    </DashboardLayout>
</template>
