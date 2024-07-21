<script setup>
import DashboardLayout from "@layouts/DashboardLayout.vue";
import { useNavMainPlatform } from "@stores/navigation_menu_item";
import { storeToRefs } from "pinia";
import { onMounted } from "vue";

const getNavMainPlatform = useNavMainPlatform();
const { navigationMenuItem, menuItemActive } = storeToRefs(getNavMainPlatform);

onMounted(() => {
    menuItemActive.value = navigationMenuItem.value[1]?.items[2];
});
</script>
<template>
    <Head>
        <title>Subscriptions</title>
    </Head>

    <DashboardLayout
        :menu-items="navigationMenuItem"
        :menu-item-active="menuItemActive"
        titleNav="Tenant Subscriptions"
    ></DashboardLayout>
</template>
