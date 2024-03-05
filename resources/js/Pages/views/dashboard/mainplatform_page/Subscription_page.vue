<script setup>
import { onMounted } from 'vue';
import DashboardLayout from '@/layouts/DashboardLayout.vue';
import { Head } from '@inertiajs/vue3';

import { useNavMainPlatform } from '@/stores/navigation_menu_item';
import { storeToRefs } from 'pinia';

const getNavMainPlatform = useNavMainPlatform()
const { navigationMenuItem } = storeToRefs(getNavMainPlatform)


onMounted(() => {
    getNavMainPlatform.updateMenusItemActive(route(route().current()))
})

</script>

<template>

    <Head title="Subscription" />

    <DashboardLayout :menu-items="navigationMenuItem">
        <template #main_content>
            <section>
                <h3 class="font-bold text-2xl">Subscription</h3>
            </section>
        </template>
    </DashboardLayout>
</template>
