<script setup>
    defineProps({
        name: String,
        duration: Number,
        price: Number,
    });
</script>

<template>
    <div class="p-5">
        <div
            id="wrap"
            class="flex-column md:flex md:flex-row py-2 rounded-md shadow-md bg-gray-100"
        >
            <div class="md:w-5/12 text-center font-medium p-5 rounded-l-md">
                <div class="font-medium">{{ name }}</div>
            </div>
            <div class="md:w-3/12 text-center p-5 border-x-2 border-gray-300">
                <p>{{ duration }} Months</p>
            </div>
            <div class="md:w-4/12 text-center p-5 rounded-r-md">
                <p>Rp. {{ price * duration }}</p>
            </div>
        </div>
    </div>
</template>
