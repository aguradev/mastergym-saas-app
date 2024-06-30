<script setup>
import { Head } from "@inertiajs/vue3";
import MainNavLayout from "@layouts/LandingPageLayout.vue";
import Banner from "@components/central-pages/landingPage/Banner.vue";
import Features from "@components/central-pages/landingPage/Features.vue";
import Integrity from "@components/central-pages/landingPage/Integrity.vue";
import Pricing from "@components/central-pages/landingPage/Pricing.vue";
import Testimonials from "@components/central-pages/landingPage/Testimonials.vue";
import Footer from "@components/central-pages/landingPage/Footer.vue";

// import { ref } from 'vue';
</script>

<template>
    <MainNavLayout>
        <Head title="Main Landing Page" />
        <!-- <div class="bg-cyan-500 h-[70px]"></div> -->
        <Banner />
        <Features />
        <Integrity />
        <Pricing />
        <Testimonials />
        <Footer />
    </MainNavLayout>
</template>
