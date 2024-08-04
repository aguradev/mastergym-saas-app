<script setup>
import { Link } from "@inertiajs/vue3";
import MembershipLayout from "@pages/dashboard/tenant_page/membership_page/MembershipLayout.vue";
</script>

<template>
    <MembershipLayout>
        <header class="px-6 py-6 w-full">
            <Link
                preserve-state
                as="button"
                class="bg-surface-600 px-4 py-3 rounded-lg flex items-center gap-x-2"
            >
                <i class="pi pi-plus"></i>
                <span>Create Plan</span>
            </Link>
        </header>
    </MembershipLayout>
</template>
