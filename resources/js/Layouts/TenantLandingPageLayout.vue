<script setup>
    import Nav from '@components/tenantPages/landingPage/Nav.vue';
    import TenantFooter from '@components/tenantPages/landingPage/TenantFooter.vue';
</script>

<template>
    <Nav />
    <slot />
    <TenantFooter />
</template>
