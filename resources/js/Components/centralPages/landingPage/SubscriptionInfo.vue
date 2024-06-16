<script setup>
    import { ref } from 'vue';

    const menus = [
        { name: 'HOME', link: '/' },
        { name: 'PRICING', link: '#pricing' },
        { name: 'CONTACT', link: '#footer' },
        { name: 'ABOUT', link: '/about' },
    ];
</script>

<template>
    <div class="p-5">
        <div
            id="wrap"
            class="flex-column md:flex md:flex-row py-2 rounded-md shadow-md bg-gray-100"
        >
            <div class="md:w-5/12 text-center font-medium p-5 rounded-l-md">
                <div class="font-medium">Ultimate Subscription</div>
            </div>
            <div class="md:w-3/12 text-center p-5 border-x-2 border-gray-300"><p>6 Months</p></div>
            <div class="md:w-4/12 text-center p-5 rounded-r-md"><p>Rp. 1.000.000</p></div>
        </div>
    </div>
</template>
