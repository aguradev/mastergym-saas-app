<script setup>
import DashboardTenantLayout from "@layouts/DashboardTenantLayout.vue";
import Toast from "primevue/toast";
import { useToast } from "primevue/usetoast";
import { usePage } from "@inertiajs/vue3";
import { watchEffect } from "vue";

const toast = useToast();
const page = usePage();

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
        <section>
            <slot />
        </section>
    </DashboardTenantLayout>
</template>
