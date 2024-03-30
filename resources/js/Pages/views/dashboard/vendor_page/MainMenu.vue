<script setup>
import DashboardLayout from '@/layouts/DashboardLayout.vue';
import { reactive } from 'vue';

const props = defineProps({
    vendor: String,
})
</script>

<template>
    <DashboardLayout :menu-items="menuItems">
        <template #main_content>
            <section>
                <div>Hello world {{ props.vendor }}</div>
            </section>
        </template>
    </DashboardLayout>
</template>
