<script setup>
    import { Head } from '@inertiajs/vue3';
    import MainNavLayout from '@layouts/LandingPageLayout.vue';
    import Banner from '@components/centralPages/landingPage/Banner.vue';
    import Features from '@components/centralPages/landingPage/Features.vue';
    import Integrity from '@components/centralPages/landingPage/Integrity.vue';
    import Pricing from '@components/centralPages/landingPage/Pricing.vue';
    import Testimonials from '@components/centralPages/landingPage/Testimonials.vue';
    import Footer from '@components/centralPages/landingPage/Footer.vue';

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
