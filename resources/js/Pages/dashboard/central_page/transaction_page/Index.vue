<script setup>
import { Head, Link, router, useForm, usePage } from "@inertiajs/vue3";
import { route } from "ziggy-js";
import { useNavMainPlatform } from "@stores/navigation_menu_item";
import Badge from "primevue/badge";
import { storeToRefs } from "pinia";

import DashboardLayout from "@layouts/DashboardLayout.vue";
import Modal from "@components/ui/modal/Index.vue";
import {
    computed,
    defineAsyncComponent,
    onMounted,
    ref,
    toRef,
    toRefs,
    watch,
} from "vue";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import NotFound from "@components/ui/cta/NotFound.vue";
import TablePagination from "@components/elements/pagination/TablePagination.vue";
import FormatCurrency from "../../../../Lib/Currency";

const getNavMainPlatform = useNavMainPlatform();
const { navigationMenuItem, menuItemActive } = storeToRefs(getNavMainPlatform);

const page = usePage();
const transactions = computed(() => page.props.transactions);

const modalTransactionDetailVisible = ref(false);
const transactionSelected = ref(null);
const selectedSearch = ref("ORDER_ID");
const searchValueInput = ref("");

onMounted(() => {
    menuItemActive.value = navigationMenuItem.value[1]?.items[3];
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

const handlerSearchFeature = computed(() => {
    const urlParams = new URL(route("central-dashboard.transactions.lists"));

    if (searchValueInput.value !== "" && selectedSearch.value) {
        urlParams.searchParams.append("type", selectedSearch.value);
        urlParams.searchParams.append("search", searchValueInput.value);
    }

    return urlParams;
});

watch(
    () => handlerSearchFeature.value,
    (newStateValue) => {
        router.visit(newStateValue, {
            preserveScroll: true,
            preserveState: true,
            replace: true,
        });
    },
);
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
        <div class="px-6 py-4 flex items-center justify-between gap-4">
            <div class="flex items-center gap-2">
                <select
                    name="search-select"
                    class="px-4 py-3 rounded-lg bg-primary-800 outline-none w-[180px]"
                    @change="(e) => (selectedSearch = e.target.value)"
                >
                    <option
                        value="ORDER_ID"
                        :selected="selectedSearch === 'ORDER_ID'"
                    >
                        Order id
                    </option>
                    <option
                        value="EMAIL"
                        :selected="selectedSearch === 'EMAIL'"
                    >
                        Email
                    </option>
                </select>
                <input
                    type="text"
                    class="px-4 py-3 rounded-lg bg-primary-800 outline-none w-[400px]"
                    :placeholder="`Search ${selectedSearch}`"
                    @input="(e) => (searchValueInput = e.target.value)"
                />
            </div>
            <div class="text-right">
                <Link
                    as="button"
                    type="button"
                    class="bg-primary-700 hover:bg-primary-600 px-4 py-3 rounded-lg"
                >
                    <div class="flex items-center gap-3">
                        <i class="pi pi-download"></i>
                        <span> Export CSV </span>
                    </div>
                </Link>
            </div>
        </div>
        <div class="px-8 mt-3 flex items-center gap-5" v-if="searchValueInput">
            <p>Result: {{ searchValueInput }}</p>
            <p>Found: {{ transactions.total }}</p>
        </div>
        <div v-if="transactions.data.length <= 0">
            <NotFound caption="No transaction data" />
        </div>
        <div v-else>
            <DataTable
                :value="transactions.data"
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
