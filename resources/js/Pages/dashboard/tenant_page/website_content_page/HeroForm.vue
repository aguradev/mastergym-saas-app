<script setup>
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';

import TenantContentLayout from '@layouts/TenantContentLayout.vue';

</script>

<template>

    <Head title="Hero Content" />
    <TenantContentLayout>
        <p>Hero</p>
    </TenantContentLayout>
</template>
