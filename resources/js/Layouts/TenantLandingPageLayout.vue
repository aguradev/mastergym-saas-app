<script setup>
import { onMounted, ref } from 'vue'
import Nav from "@components/tenant-pages/landingPage/Nav.vue";
import TenantFooter from "@components/tenant-pages/landingPage/TenantFooter.vue";
</script>

<template>
    <Nav />
    <article>
        <slot />
        <TenantFooter />
    </article>
</template>
