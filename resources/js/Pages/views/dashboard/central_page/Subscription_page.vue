<script setup>
import { onMounted } from 'vue';
import DashboardLayout from '@/layouts/DashboardLayout.vue';
import { Head } from '@inertiajs/vue3';

import { useNavMainPlatform } from '@/stores/navigation_menu_item';
import { storeToRefs } from 'pinia';

const getNavMainPlatform = useNavMainPlatform()
const { updateMenusItemActive } = getNavMainPlatform
const { navigationMenuItem } = storeToRefs(getNavMainPlatform)


onMounted(() => {
    updateMenusItemActive(route(route().current()))
})

</script>

<template>

    <Head title="Subscription" />

    <DashboardLayout :menu-items="navigationMenuItem" titleNav="Subscription">
        <template #main_content>
            <section>

            </section>
        </template>
    </DashboardLayout>
</template>
