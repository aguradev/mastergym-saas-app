<script setup>
import { ref } from 'vue';

import DashboardLayout from './DashboardLayout.vue';
import TabViewPage from '@components/elements/tabview/TabViewPage.vue';

import { useNavTenantPlatform } from '@stores/tenant_menu_item';
import { useContentMenus } from '@stores/content_menus';

import { storeToRefs } from 'pinia';
import { onMounted } from 'vue';


const getNavTenantPlatform = useNavTenantPlatform();
const getContentMenus = useContentMenus();

const { contentMenus } = getContentMenus;
const { navigationMenuItem, menuItemActive } = storeToRefs(getNavTenantPlatform);

onMounted(() => {
    menuItemActive.value = navigationMenuItem.value[1]?.items[1]
})

</script>

<template>
    <DashboardLayout :menu-items="navigationMenuItem" :menu-item-active="menuItemActive"
        titleNav="Manage Website Content">
        <template #main_content>
            <TabViewPage :tabUrl="contentMenus" />
            <slot />
        </template>
    </DashboardLayout>
</template>