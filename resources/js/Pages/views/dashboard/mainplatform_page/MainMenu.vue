<script setup>
import { reactive } from 'vue';
import DashboardLayout from '@/layouts/DashboardLayout.vue';

const navigationMenuItem = reactive([
    {
        separator: true
    },
    {
        label: "Menus",
        items: [
            {
                "icon": "pi pi-home",
                label: "Dashboard"
            },
            {
                "icon": "pi pi-users",
                label: "Subscriptions"
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
    <DashboardLayout :menu-items="navigationMenuItem">
        <template #main_content>
            <section>
                <div>Hello Admin</div>
            </section>
        </template>
    </DashboardLayout>
</template>
