<script setup>
import { ref, toRefs } from 'vue';
import { Head, usePage } from '@inertiajs/vue3';

import TenantContentLayout from '@layouts/TenantContentLayout.vue';
import TestiForm from '@components/tenant-pages/dashboard/website/TestiForm.vue'


</script>

<template>

    <Head title="Testimony Content" />
    <TenantContentLayout>
        <p>Testimony</p>
        <TestiForm />
    </TenantContentLayout>
</template>
