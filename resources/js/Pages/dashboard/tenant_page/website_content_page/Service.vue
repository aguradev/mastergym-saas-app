<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';

import TenantContentLayout from '@layouts/TenantContentLayout.vue';
import ServiceForm from '@components/tenant-pages/dashboard/website/ServiceForm.vue'

</script>

<template>

    <Head title="Service Content" />
    <TenantContentLayout>
        <div class="grid grid-cols-1 gap-6 pl-8 pt-6">
            <div class="col-span-3">
                <ServiceForm />
            </div>
        </div>
    </TenantContentLayout>
</template>
