<script setup>
import DashboardLayout from "@layouts/DashboardLayout.vue";
import { reactive } from "vue";

const props = defineProps({
    vendor: String,
});
</script>

<template>
    <DashboardLayout :menu-items="menuItems">
        <section>
            <div>Hello world {{ props.vendor }}</div>
        </section>
    </DashboardLayout>
</template>
