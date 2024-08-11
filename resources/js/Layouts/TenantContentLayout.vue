<script setup>
    import { onMounted, watchEffect } from 'vue';
    import { storeToRefs } from 'pinia';

    import { useContentMenus } from '@stores/content_menus';
    import { useNavTenantPlatform } from '@stores/tenant_menu_item';

    import DashboardLayout from './DashboardLayout.vue';
    import TabViewPage from '@components/elements/tabview/TabViewPage.vue';
    import { useToast } from 'primevue/usetoast';
    import Toast from 'primevue/toast';
    import { usePage } from '@inertiajs/vue3';

    const getNavTenantPlatform = useNavTenantPlatform();
    const getContentMenus = useContentMenus();

    const { contentMenus } = getContentMenus;
    const { navigationMenuItem, menuItemActive } = storeToRefs(getNavTenantPlatform);

    const page = usePage();
    const toast = useToast();

    onMounted(() => {
        menuItemActive.value = navigationMenuItem.value[1]?.items[4];
    });

    watchEffect(() => {
        if (page.props.flash?.message_success) {
            toast.add({
                severity: 'success',
                summary: 'info',
                detail: page.props.flash?.message_success,
                life: 3000,
            });
        }
        if (page.props.flash?.message_error) {
            toast.add({
                severity: 'error',
                summary: 'info',
                detail: page.props.flash?.message_error,
                life: 3000,
            });
        }
    });
</script>

<template>
    <DashboardLayout
        :menu-items="navigationMenuItem"
        :menu-item-active="menuItemActive"
        titleNav="Manage Website Content"
    >
        <Toast />
        <TabViewPage :tabUrl="contentMenus" />
        <slot />
    </DashboardLayout>
</template>
