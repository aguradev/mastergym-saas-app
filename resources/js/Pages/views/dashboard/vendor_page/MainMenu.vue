<script setup>
import DashboardLayout from '@/layouts/DashboardLayout.vue';
import { reactive } from 'vue';

const props = defineProps({
    vendor__name: String,
})
</script>

<template>
    <DashboardLayout :menu-items="menuItems">
        <template #main_content>
            <section>
                <div>Hello world {{ props.vendor__name }}</div>
            </section>
        </template>
    </DashboardLayout>
</template>
