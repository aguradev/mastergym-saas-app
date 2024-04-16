<script setup>
    import { Head } from '@inertiajs/vue3';
    import MainNavLayout from '@/layouts/MainNavLayout.vue';
    import Banner from './Banner.vue';
    import Features from './Features.vue';
    import Integrity from './Integrity.vue';
    import Pricing from './Pricing.vue';
    import Footer from './Footer.vue';

    import { ref } from 'vue';
</script>

<template>
    <MainNavLayout>
        <Head title="Main Landing Page" />
        <!-- <div class="bg-cyan-500 h-[70px]"></div> -->
        <Banner />
        <Features />
        <Integrity />
        <Pricing />
        <Footer />
    </MainNavLayout>
</template>
