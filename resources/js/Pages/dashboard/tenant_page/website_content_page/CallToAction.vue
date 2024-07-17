<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';

import TenantContentLayout from '@layouts/TenantContentLayout.vue';

</script>

<template>

    <Head title="CTA Content" />
    <TenantContentLayout>
        <p>Call To Action</p>
        <div id="wrap">
            <div id="left"></div>
            <div id="right"></div>
        </div>
    </TenantContentLayout>
</template>
