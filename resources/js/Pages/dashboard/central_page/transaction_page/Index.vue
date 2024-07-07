<script setup>
import { Head } from "@inertiajs/vue3";
import { useNavMainPlatform } from "@stores/navigation_menu_item";
import { useMenuUser } from "@stores/menu_dropdown_user";
import { storeToRefs } from "pinia";

import DashboardLayout from "@layouts/DashboardLayout.vue";
import { onMounted } from "vue";
import DataTable from "primevue/datatable";
import Column from "primevue/column";

const getNavMainPlatform = useNavMainPlatform();
const { navigationMenuItem, menuItemActive } = storeToRefs(getNavMainPlatform);

onMounted(() => {
    menuItemActive.value = navigationMenuItem.value[1]?.items[4];
});
</script>

<template>
    <Head>
        <title>Transactions</title>
    </Head>

    <DashboardLayout
        :menu-items="navigationMenuItem"
        :menu-item-active="menuItemActive"
        titleNav="Transaction"
    >
        <DataTable
            :pt="{
                bodyrow:
                    'bg-transparent last:border-none border-b border-primary-700 odd:bg-primary-800',
                column: {
                    headercell: 'py-6 px-12 border-b border-primary-600',
                    headercontent:
                        'text-left font-[300] tracking-wide text-white/50',
                    bodycell: 'px-12 py-6 text-base',
                },
            }"
        >
            <Column header="No"></Column>
            <Column header="Full Name"></Column>
            <Column header="Email"></Column>
            <Column header="Status"></Column>
            <Column header="Actions"></Column>
        </DataTable>
    </DashboardLayout>
</template>
