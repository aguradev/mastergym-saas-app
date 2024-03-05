<script setup>
import { onMounted } from 'vue';
import DashboardLayout from '@/layouts/DashboardLayout.vue';
import { useNavMainPlatform } from '@/stores/navigation_menu_item';
import { storeToRefs } from 'pinia';

const getNavMainPlatform = useNavMainPlatform()
const { navigationMenuItem } = storeToRefs(getNavMainPlatform)


onMounted(() => {
    getNavMainPlatform.updateMenusItemActive(route(route().current()))
})

</script>

<template>
    <DashboardLayout :menu-items="navigationMenuItem">
        <template #main_content>
            <section>
                <h3 class="font-bold text-2xl">Overview</h3>
            </section>
        </template>
    </DashboardLayout>
</template>
