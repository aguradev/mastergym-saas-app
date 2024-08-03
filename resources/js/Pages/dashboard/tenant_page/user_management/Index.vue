<script setup>
import TabViewPage from "@components/elements/tabview/TabViewPage.vue";
import DashboardTenantLayout from "@layouts/DashboardTenantLayout.vue";
import { route } from "ziggy-js";
import Toast from "primevue/toast";
import { useToast } from "primevue/usetoast";
import { usePage } from "@inertiajs/vue3";
import { watchEffect } from "vue";

const toast = useToast();
const page = usePage();

const tabMenus = [
    {
        title: "Users",
        url: route("tenant-dashboard.user-management.users"),
    },
    {
        title: "Roles",
        url: route("tenant-dashboard.user-management.roles"),
    },
];

watchEffect(() => {
    if (page.props.flash?.message_error) {
        toast.add({
            severity: "error",
            summary: "info",
            detail: page.props.flash?.message_error,
            life: 3000,
        });
    }

    if (page.props.flash?.message_success) {
        toast.add({
            severity: "success",
            summary: "info",
            detail: page.props.flash?.message_success,
            life: 3000,
        });
    }
});
</script>

<template>
    <DashboardTenantLayout>
        <Toast />
        <TabViewPage :tab-url="tabMenus" />

        <section>
            <slot />
        </section>
    </DashboardTenantLayout>
</template>
