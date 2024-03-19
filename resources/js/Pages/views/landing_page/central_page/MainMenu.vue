<script setup>
    import { Head } from '@inertiajs/vue3';
    import MainNavLayout from '@/layouts/MainNavLayout.vue';
    import Banner from './Banner.vue';
    import Button from 'primevue/button';

    import { ref } from 'vue';
</script>

<template>
    <MainNavLayout>
        <Head title="Main Landing Page" />
        <div class="bg-cyan-500 h-[70px]"></div>
        <Banner />
    </MainNavLayout>
</template>
