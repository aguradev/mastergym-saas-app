<script setup>
import { Head } from "@inertiajs/vue3";
import { useNavMainPlatform } from "@stores/navigation_menu_item";
import { useMenuUser } from "@stores/menu_dropdown_user";
import { storeToRefs } from "pinia";

import DashboardLayout from "@layouts/DashboardLayout.vue";
import { onMounted } from "vue";

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
    </DashboardLayout>
</template>
