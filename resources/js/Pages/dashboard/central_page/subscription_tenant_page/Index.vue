<script setup>
import NotFound from "@components/ui/cta/NotFound.vue";
import { Head, Link, router, usePage } from "@inertiajs/vue3";
import DashboardLayout from "@layouts/DashboardLayout.vue";
import { useNavMainPlatform } from "@stores/navigation_menu_item";
import { storeToRefs } from "pinia";
import Column from "primevue/column";
import DataTable from "primevue/datatable";
import { computed, onMounted, toRef, watchEffect } from "vue";
import Badge from "primevue/badge";
import { route } from "ziggy-js";
import Modal from "@components/ui/modal/Index.vue";
import SubscriptionInfoDetail from "./Detail.vue";

const getNavMainPlatform = useNavMainPlatform();
const { navigationMenuItem, menuItemActive } = storeToRefs(getNavMainPlatform);
const page = usePage();
const tenantSubscriptionsLists = computed(
    () => page.props.tenantSubscriptionsLists,
);
const visibleModalDetail = toRef(() => page.props.visibleModalDetail);

const closeModalDetailHandler = () => {
    router.visit(route("central-dashboard.tenant-subscription.index"), {
        replace: true,
    });
};

onMounted(() => {
    console.log(tenantSubscriptionsLists.value);
    menuItemActive.value = navigationMenuItem.value[1]?.items[2];
});

watchEffect(() => {
    console.log(visibleModalDetail.value);
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
        <title>Tenant Subscription</title>
    </Head>

    <DashboardLayout
        :menu-items="navigationMenuItem"
        :menu-item-active="menuItemActive"
        titleNav="Tenant Subscriptions"
    >
        <div v-if="tenantSubscriptionsLists.length <= 0">
            <NotFound caption="No Subscriptions data" />
        </div>
        <div v-else>
            <DataTable
                :value="tenantSubscriptionsLists"
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
                <Column header="Tenant name">
                    <template #body="slotProps">
                        <p class="text-nowrap">
                            {{ slotProps.data.tenant.name }}
                        </p>
                    </template>
                </Column>
                <Column header="Plan Purchase">
                    <template #body="slotProps">
                        <p class="text-nowrap">
                            {{
                                slotProps.data.transaction.plan_purchase
                                    .tenant_subscription_plan.name
                            }}
                        </p>
                    </template>
                </Column>
                <Column header="Domain">
                    <template #body="slotProps">
                        <p>
                            {{ slotProps.data.tenant.domains[0].domain }}
                        </p>
                    </template>
                </Column>
                <Column header="Period type">
                    <template #body="slotProps">
                        <p class="text-nowrap">
                            {{ slotProps.data.transaction.period_type }}
                        </p>
                    </template>
                </Column>
                <Column header="Tenant Email">
                    <template #body="slotProps">
                        <p class="text-nowrap">
                            {{ slotProps.data.tenant.email }}
                        </p>
                    </template>
                </Column>
                <Column header="Subscription status">
                    <template #body="slotProps">
                        <Badge
                            class="px-4 !text-white"
                            :severity="[
                                slotProps.data.status === 'ACTIVE'
                                    ? 'success'
                                    : 'danger',
                            ]"
                            :value="slotProps.data.status"
                        />
                    </template>
                </Column>
                <Column header="Action">
                    <template #body="slotProps">
                        <ul class="action_lists">
                            <li class="action_item">
                                <Link
                                    :href="
                                        route(
                                            'central-dashboard.tenant-subscription.index',
                                            {
                                                subscription_id:
                                                    slotProps.data.id,
                                            },
                                        )
                                    "
                                    type="button"
                                    class="action_link"
                                    preserve-state
                                    :only="[
                                        'visibleModalDetail',
                                        'getSubscriptionDataDetail',
                                    ]"
                                >
                                    <i class="pi pi-eye"></i>
                                </Link>
                            </li>
                        </ul>
                    </template>
                </Column>
            </DataTable>

            <Modal
                title="Subscription detail"
                :modal-visible="visibleModalDetail"
                @close-modal="closeModalDetailHandler"
            >
                <SubscriptionInfoDetail />
            </Modal>
        </div>
    </DashboardLayout>
</template>
