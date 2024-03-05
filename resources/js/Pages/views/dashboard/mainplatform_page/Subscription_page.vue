<script setup>
import { reactive } from 'vue';
import DashboardLayout from '@/layouts/DashboardLayout.vue';
import { Head } from '@inertiajs/vue3';

const navigationMenuItem = reactive([
    {
        separator: true
    },
    {
        label: "Menus",
        items: [
            {
                "icon": "pi pi-home",
                label: "Dashboard",
                link: route('main.dashboard')
            },
            {
                "icon": "pi pi-users",
                label: "Subscriptions",
                link: route('main.dashboard.subscription')
            },
            {
                "icon": "pi pi-building",
                label: "Vendor Lists"
            }
        ]
    },
    {
        label: "Users",
        items: [
            {
                "icon": "pi pi-users",
                "label": "Owner Vendor"
            },
            {
                "icon": "pi pi-users",
                "label": "Staff Vendor"
            },
            {
                "icon": "pi pi-users",
                "label": "User Member Vendor"
            }
        ]
    },
    {
        separator: true
    }
])
</script>

<template>

    <Head title="Subscription" />

    <DashboardLayout :menu-items="navigationMenuItem">
        <template #main_content>
            <section>
                <div>Halaman Subcription</div>
            </section>
        </template>
    </DashboardLayout>
</template>
