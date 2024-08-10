<script setup>
    import { ref } from 'vue';
    import { Head } from '@inertiajs/vue3';

    import TenantContentLayout from '@layouts/TenantContentLayout.vue';
    import CtaForm from '@components/tenant-pages/dashboard/website/CtaForm.vue';
</script>

<template>
    <Head title="CTA Content" />
    <TenantContentLayout>
        <div class="grid grid-cols-5 grid-rows-1 px-8 pt-6">
            <div
                id="form"
                class="col-span-4"
            >
                <CtaForm />
            </div>
            <div
                id="preview"
                class="text-center col-span-1"
            ></div>
        </div>
    </TenantContentLayout>
</template>
