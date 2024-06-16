<script setup>
import { onMounted, watchEffect } from 'vue';
import DashboardLayout from '@layouts/DashboardLayout.vue';

import { useNavMainPlatform } from '@stores/navigation_menu_item';
import { storeToRefs } from 'pinia';
import TabViewPage from '@components/elements/tabview/TabViewPage.vue';
import { usePlanMenus } from '@stores/plan_menus';
import { Head, usePage } from '@inertiajs/vue3';
import { useToast } from 'primevue/usetoast';
import Toast from 'primevue/toast';

const toast = useToast();
const page = usePage();
const getNavMainPlatform = useNavMainPlatform()
const getPlanMenus = usePlanMenus();

const { tabContents } = getPlanMenus;
const { navigationMenuItem, menuItemActive } = storeToRefs(getNavMainPlatform)

onMounted(() => {
    menuItemActive.value = navigationMenuItem.value[1]?.items[1]
})

watchEffect(() => {
    if (page.props.flash?.message_success) {
        toast.add({
            severity: "success",
            summary: "info",
            detail: page.props.flash?.message_success,
            life: 3000
        })
    }
    if (page.props.flash?.message_error) {
        toast.add({
            severity: "error",
            summary: "info",
            detail: page.props.flash?.message_error,
            life: 3000
        })
    }
})

</script>

<template>

    <Head title="Plan Tenants" />

    <DashboardLayout :menu-items="navigationMenuItem" :menu-item-active="menuItemActive" titleNav="Plan Tenants">
        <template #main_content>
            <Toast />
            <TabViewPage :tabUrl="tabContents" />
            <slot />

        </template>
    </DashboardLayout>
</template>
