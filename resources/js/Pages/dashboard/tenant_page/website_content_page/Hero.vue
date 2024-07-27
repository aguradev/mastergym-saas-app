<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';

import TenantContentLayout from '@layouts/TenantContentLayout.vue';
import HeroForm from '@components/tenant-pages/dashboard/website/HeroForm.vue';

</script>

<template>

    <Head title="Hero Content" />
    <TenantContentLayout>
        <div class="grid grid-cols-5 gap-6 px-8 pt-6">
            <div id="form" class="col-span-3">
                <HeroForm />
            </div>
            <div id="preview" class="text-center col-span-2">
                <p class="pb-6 text-xl font-medium">Preview Hero Section</p>
                <img src="/public/assets/images/preview/hero-prev.png" alt="" srcset="">
            </div>
        </div>
    </TenantContentLayout>
</template>
