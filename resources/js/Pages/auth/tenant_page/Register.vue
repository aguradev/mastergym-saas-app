<script setup>
import RegisterForm from "@components/tenant-pages/dashboard/forms/RegisterForm.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Member register" />
    <div class="grid grid-rows-1 grid-cols-1 md:grid-cols-2">
        <div id="left" class="max-h-screen col-span-1">
            <img
                src="/public/assets/images/img/registercropped.jpg"
                class="h-screen size-full"
            />
        </div>
        <div id="right" class="col-span-1">
            <RegisterForm />
        </div>
    </div>
</template>
