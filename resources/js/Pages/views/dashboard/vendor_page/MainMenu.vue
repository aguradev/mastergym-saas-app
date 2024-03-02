<script setup>
import Button from 'primevue/button';
import DashboardLayout from '@/layouts/DashboardLayout.vue';
import { reactive } from 'vue';

const props = defineProps({
    vendor__name: String,
})

const menuItems = reactive([
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
    <DashboardLayout :menu-items="menuItems">
        <template #main_content>
            <section>
                <div>Hello world {{ props.vendor__name }}</div>
                <Button>Hello World</Button>
            </section>
        </template>
    </DashboardLayout>
</template>
