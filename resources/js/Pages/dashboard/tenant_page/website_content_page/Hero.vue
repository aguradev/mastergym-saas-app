<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';

import TenantContentLayout from '@layouts/TenantContentLayout.vue';
import HeroForm from '@components/tenant-pages/dashboard/website/HeroForm.vue';
</script>

<template>

    <Head title="Hero Content" />
    <TenantContentLayout>
        <h1 class="px-8 py-8 text-2xl font-bold ">Edit Hero Content</h1>
        <div class="grid grid-cols-3 gap-6 px-8">
            <div id="form" class="col-span-2 pr-10">
                <HeroForm />
            </div>
            <div id="preview" class="">
                <img src="/public/assets/images/preview/hero-prev.png" alt="" srcset="">
            </div>
        </div>
    </TenantContentLayout>
</template>
