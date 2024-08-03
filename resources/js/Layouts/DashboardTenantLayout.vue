<script setup>
import { onMounted, watchEffect } from "vue";
import { storeToRefs } from "pinia";

import { useContentMenus } from "@stores/content_menus";
import { useNavTenantPlatform } from "@stores/tenant_menu_item";

import DashboardLayout from "./DashboardLayout.vue";
import { usePage } from "@inertiajs/vue3";

const page = usePage();

const getNavTenantPlatform = useNavTenantPlatform();
const menuItemActivePosition = page.props.indexMenuActive || 0;

const { navigationMenuItem, menuItemActive } =
    storeToRefs(getNavTenantPlatform);

onMounted(() => {
    menuItemActive.value =
        navigationMenuItem.value[1]?.items[menuItemActivePosition];
});
</script>

<template>
    <DashboardLayout
        :menu-items="navigationMenuItem"
        :menu-item-active="menuItemActive"
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
