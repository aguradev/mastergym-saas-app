<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';

import TenantContentLayout from '@layouts/TenantContentLayout.vue';
import FooterForm from '@components/tenant-pages/dashboard/website/FooterForm.vue'

</script>

<template>

    <Head title="Footer Content" />
    <TenantContentLayout>
        <div>
            <FooterForm />
        </div>
    </TenantContentLayout>
</template>
