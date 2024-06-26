<script setup>
import { Head } from '@inertiajs/vue3';

import TenantLayout from '@layouts/TenantLandingPageLayout.vue';

import Hero from '@components/tenantPages/landingPage/Hero.vue';
import CTA from '@components/tenantPages/landingPage/CallToAction.vue';
import Service from '@components/tenantPages/landingPage/Service.vue';
import Testimonials from '@components/tenantPages/landingPage/Testimonials.vue';
</script>

<template>

    <Head title="Tenant" />
    <div class="bg-white h-screen">
        <TenantLayout>
            <Hero />
            <CTA />
            <Service />
            <Testimonials />
        </TenantLayout>
    </div>
</template>
