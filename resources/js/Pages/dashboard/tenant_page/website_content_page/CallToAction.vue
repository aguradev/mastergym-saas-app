<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';

import TenantContentLayout from '@layouts/TenantContentLayout.vue';
import CtaForm from '@components/tenant-pages/dashboard/website/CtaForm.vue';

</script>

<template>

    <Head title="CTA Content" />
    <TenantContentLayout>
        <div class="grid grid-cols-5 gap-6 px-8 pt-6">
            <div id="form" class="col-span-3">
                <CtaForm />
            </div>
            <div id="preview" class="text-center col-span-2">
                <p class="pb-6 text-xl font-medium">Preview Call to Action Section</p>
                <img src="/public/assets/images/preview/hero-prev.png" alt="" srcset="">
            </div>
        </div>
    </TenantContentLayout>
</template>
