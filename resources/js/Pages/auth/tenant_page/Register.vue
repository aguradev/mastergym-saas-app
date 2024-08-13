<script setup>
    import RegisterForm from '@components/tenant-pages/dashboard/forms/RegisterForm.vue';
</script>

<template>
    <div class="grid grid-rows-1 grid-cols-1 md:grid-cols-2">
        <div
            id="left"
            class="max-h-screen col-span-1"
        >
            <img
                src="/public/assets/images/img/registercropped.jpg"
                class="h-screen size-full"
            />
            <div class="bg-black opacity-50 absolute top-0 h-screen w-1/2 grid justify-center content-center">
                <p class="top-10 text-6xl font-medium">GYM TENANT NAME</p>
            </div>
        </div>
        <div
            id="right"
            class="col-span-1"
        >
            <RegisterForm />
        </div>
    </div>
</template>
