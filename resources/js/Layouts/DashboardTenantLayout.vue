<script setup>
import { computed, onMounted, ref, toRef, watchEffect } from "vue";
import { storeToRefs } from "pinia";

import { useNavTenantPlatform } from "@stores/tenant_menu_item";

import DashboardLayout from "./DashboardLayout.vue";
import { usePage } from "@inertiajs/vue3";
import { useNavMemberDashboard } from "@stores/member_tenant_menu";

const page = usePage();
const permissions = computed(() => page.props.permissions);
const navigationItem = ref(null);
const navigationItemActive = ref(null);
const menuItemActivePosition = page.props.indexMenuActive || 0;

if (permissions.value?.access_dashboard_menu_tenant) {
    const DashboardMenuTenant = useNavTenantPlatform();
    const { navigationMenuItem, menuItemActive } =
        storeToRefs(DashboardMenuTenant);

    navigationItem.value = navigationMenuItem.value;
    navigationItemActive.value = menuItemActive.value;
} else {
    const DashboardMenuTenant = useNavMemberDashboard();
    const { navigationMenuItem, menuItemActive } =
        storeToRefs(DashboardMenuTenant);

    navigationItem.value = navigationMenuItem.value;
    navigationItemActive.value = menuItemActive.value;
}

onMounted(() => {
    navigationItemActive.value =
        navigationItem.value[1]?.items[menuItemActivePosition];
});
</script>

<template>
    <DashboardLayout
        :menu-items="navigationItem"
        :menu-item-active="navigationItemActive"
        :meta-head="{
            title: page.props?.title,
        }"
        :title-nav="page.props?.titleNav"
    >
        <main>
            <slot />
        </main>
    </DashboardLayout>
</template>
