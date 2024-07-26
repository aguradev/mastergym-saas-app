<script setup>
import NotFound from "@components/ui/cta/NotFound.vue";
import { Link, usePage } from "@inertiajs/vue3";
import DashboardLayout from "@layouts/DashboardLayout.vue";
import { useNavMainPlatform } from "@stores/navigation_menu_item";
import { storeToRefs } from "pinia";
import Column from "primevue/column";
import DataTable from "primevue/datatable";
import { computed, onMounted } from "vue";
import Badge from "primevue/badge";

const getNavMainPlatform = useNavMainPlatform();
const { navigationMenuItem, menuItemActive } = storeToRefs(getNavMainPlatform);
const page = usePage();
const tenantSubscriptionsLists = computed(
    () => page.props.tenantSubscriptionsLists,
);

onMounted(() => {
    console.log(tenantSubscriptionsLists.value);
    menuItemActive.value = navigationMenuItem.value[1]?.items[2];
});
</script>
<template>
    <Head>
        <title>Subscriptions</title>
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
                <Column header="Owner">
                    <template #body="slotProps">
                        <p class="text-nowrap">
                            {{ slotProps.data.transaction.full_name }}
                        </p>
                    </template>
                </Column>
                <Column header="Tenant name">
                    <template #body="slotProps">
                        <p class="text-nowrap">
                            {{ slotProps.data.tenant.name }}
                        </p>
                    </template>
                </Column>
                <Column header="Domain">
                    <template #body="slotProps">
                        <button
                            type="button"
                            class="underline"
                            @click="
                                () =>
                                    redirectToTenant(
                                        slotProps.data.tenant.domains[0].domain,
                                    )
                            "
                        >
                            {{ slotProps.data.tenant.domains[0].domain }}
                        </button>
                    </template>
                </Column>
                <Column header="Address">
                    <template #body="slotProps">
                        <p class="text-nowrap">
                            {{ slotProps.data.tenant.address }}
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
                <Column header="Status">
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
                <Column header="Action"></Column>
            </DataTable>
        </div>
    </DashboardLayout>
</template>
