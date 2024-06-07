<script setup>
    import { ref } from 'vue';
    import { Head, Link } from '@inertiajs/vue3';
</script>

<style scoped></style>

<template>
    <Head title="Payment Page" />
    <div
        id="background_drop"
        class="w-screen h-screen bg-[url('/public/storage/images/svg/stacked-waves-haikei2.svg')] flex justify-center py-10"
    >
        <div class="card shadow-xl bg-white flex-row w-2/5 rounded-2xl text-black p-5">
            <div
                id="title"
                class="bg-red-50 rounded-xl h-1/6 text-center p-10"
            >
                <p class="text-3xl font-medium">Payment Page</p>
            </div>
            <div
                id="user"
                class="bg-blue-50 h-1/6"
            >
                User data
            </div>
            <div
                id="subscription"
                class="bg-indigo-50 h-3/6"
            >
                Subsctiption information
            </div>
            <div
                id="payment"
                class="bg-orange-50 h-1/6"
            >
                <Link class=""> Proceed to Payment </Link>
            </div>
        </div>
    </div>
</template>
