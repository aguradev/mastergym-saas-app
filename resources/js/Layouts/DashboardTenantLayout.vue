<script setup>
import { onMounted, watchEffect } from "vue";
import { storeToRefs } from "pinia";

import { useContentMenus } from "@stores/content_menus";
import { useNavTenantPlatform } from "@stores/tenant_menu_item";

import DashboardLayout from "./DashboardLayout.vue";
import { usePage } from "@inertiajs/vue3";

const getNavTenantPlatform = useNavTenantPlatform();
const getContentMenus = useContentMenus();

const { navigationMenuItem, menuItemActive } =
    storeToRefs(getNavTenantPlatform);

const page = usePage();

onMounted(() => {
    menuItemActive.value = navigationMenuItem.value[1]?.items[0];
});
</script>

<template>
    <DashboardLayout
        :menu-items="navigationMenuItem"
        :menu-item-active="menuItemActive"
        :meta-head="{
            title: page.props?.title,
        }"
    >
        <main class="px-8">
            <slot />
        </main>
    </DashboardLayout>
</template>
