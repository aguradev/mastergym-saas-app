<script setup>
import { Head } from "@inertiajs/vue3";

import TenantLayout from "@layouts/TenantLandingPageLayout.vue";

import Hero from "@components/tenant-pages/landingPage/Hero.vue";
import CTA from "@components/tenant-pages/landingPage/CallToAction.vue";
import Service from "@components/tenant-pages/landingPage/Service.vue";
import Pricing from "@components/tenant-pages/landingPage/Pricing.vue";
import Testimonials from "@components/tenant-pages/landingPage/Testimonials.vue";
</script>

<template>

    <Head title="Tenant" />
    <div class="bg-white h-screen">
        <TenantLayout>
            <Hero />
            <CTA />
            <Service />
            <Pricing />
            <Testimonials />
        </TenantLayout>
    </div>
</template>
