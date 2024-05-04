<script setup>
import { onMounted } from 'vue';
import DashboardLayout from '@/components/layouts/DashboardLayout.vue';

import { useNavMainPlatform } from '@/stores/navigation_menu_item';
import { storeToRefs } from 'pinia';
import TabViewPage from '@/components/elements/tabview/TabViewPage.vue';
import { useSubscriptionTabs } from '@/stores/subscriptions_tabs';

const getNavMainPlatform = useNavMainPlatform()
const getSubscriptionTab = useSubscriptionTabs();

const { tabContents } = getSubscriptionTab;
const { updateMenusItemActive } = getNavMainPlatform
const { navigationMenuItem } = storeToRefs(getNavMainPlatform)

onMounted(() => {
    updateMenusItemActive(route('central-dashboard.subscriptions'))
})
</script>

<template>

    <DashboardLayout :menu-items="navigationMenuItem" titleNav="Subscription Management">
        <template #main_content>

            <TabViewPage :tabUrl="tabContents" />
            <slot />

        </template>
    </DashboardLayout>
</template>
