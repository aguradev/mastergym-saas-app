<script setup>
    import { Head } from '@inertiajs/vue3';

    import TenantLayout from '@layouts/TenantLandingPageLayout.vue';
    import Hero from '@components/tenantPages/landingPage/Hero.vue';
</script>

<template>
    <Head title="Tenant" />
    <div class="bg-white">
        <TenantLayout>
            <Hero />
        </TenantLayout>
    </div>
</template>
