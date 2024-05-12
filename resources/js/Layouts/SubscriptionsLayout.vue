<script setup>
import { onMounted } from 'vue';
import DashboardLayout from '@layouts/DashboardLayout.vue';

import { useNavMainPlatform } from '@stores/navigation_menu_item';
import { storeToRefs } from 'pinia';
import TabViewPage from '@components/elements/tabview/TabViewPage.vue';
import { useSubscriptionTabs } from '@stores/subscriptions_tabs';
import { Head } from '@inertiajs/vue3';

const getNavMainPlatform = useNavMainPlatform()
const getSubscriptionTab = useSubscriptionTabs();

const { tabContents } = getSubscriptionTab;
const { navigationMenuItem, menuItemActive } = storeToRefs(getNavMainPlatform)

onMounted(() => {
    menuItemActive.value = navigationMenuItem.value[1]?.items[1]
})

</script>

<template>

    <Head title="Subscription Management" />

    <DashboardLayout :menu-items="navigationMenuItem" :menu-item-active="menuItemActive"
        titleNav="Subscription Management">
        <template #main_content>

            <TabViewPage :tabUrl="tabContents" />
            <slot />

        </template>
    </DashboardLayout>
</template>
