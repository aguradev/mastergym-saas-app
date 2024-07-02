<script setup>
import { ref } from 'vue';

import { Link } from '@inertiajs/vue3';

const isToggle = ref(false);

const link = '/signup';

const togglePricing = () => {
    isToggle.value = !isToggle.value;
};
</script>

<style scoped>
/* basic */

.basic-card {
    @apply bg-slate-500 border-slate-500
}

.basic-price {
    @apply text-orange-400
}

.basic-text {
    @apply text-white
}

.basic-text-dashed {
    @apply text-black
}

.basic-icon {
    @apply text-white
}

.basic-button {
    @apply border-orange-400 border-[3px] hover:bg-orange-500 hover:text-white focus:text-white focus:bg-orange-500 bg-white
}

/* ultimate */

.ultimate-card {
    @apply bg-orange-500
}

.ultimate-price {
    @apply text-white
}

.ultimate-text {
    @apply text-white
}

.ultimate-icon {
    @apply text-black
}

.ultimate-button {
    @apply border-red-800 text-black font-bold hover:text-orange-700 focus:bg-orange-500 bg-gradient-to-r from-white to-orange-500 hover:scale-110
}

/* premium */

.premium-card {
    @apply bg-white
}

.premium-price {
    @apply text-orange-500
}

.premium-text {
    @apply text-black
}

.premium-icon {
    @apply text-black
}

.premium-button {
    @apply text-white font-bold hover:text-orange-500 focus:bg-orange-300 bg-orange-500 hover:bg-white hover:border-orange-500
}
</style>

<template>
    <section class="py-10 bg-slate-700 sm:py-16 lg:py-24">
        <div id="pricing" class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="text-5xl font-bold leading-tight text-orange-400 sm:text-4xl lg:text-6xl">Pricing & Plans
                </h2>
                <p class="max-w-md mx-auto mt-4 text-base leading-relaxed text-white">Here is lists of our pricing
                    depending on what you need, either monthly or yearly</p>
            </div>

            <div class="mt-10">
                <div class="flex items-center justify-center space-x-2.5">
                    <span class="text-base font-medium text-white"> Monthly </span>

                    <input type="checkbox" class="peer sr-only opacity-0" id="toggle" />
                    <label @click="togglePricing" for="toggle"
                        class="relative flex h-6 w-11 cursor-pointer items-center rounded-full bg-gray-400 px-0.5 outline-gray-400 transition-colors before:h-5 before:w-5 before:rounded-full before:bg-white before:shadow before:transition-transform before:duration-300 peer-checked:bg-orange-500 peer-checked:before:translate-x-full peer-focus-visible:outline peer-focus-visible:outline-offset-2 peer-focus-visible:outline-gray-400 peer-checked:peer-focus-visible:outline-violet-500">
                        <span class="sr-only">Enable</span>
                    </label>

                    <span class="text-base font-medium text-white"> Yearly </span>
                </div>
            </div>

            <div v-if="!isToggle" class="grid max-w-6xl grid-cols-1 gap-6 mx-auto sm:grid-cols-3 mt-14 md:gap-9">
                <!-- left banner  -->
                    <div class="overflow-hidden basic-card border-2 rounded-md hover:scale-105 ease-in-out duration-300">
                        <div class="p-6 md:py-8 md:px-9">
                            <h3 class="text-xl font-semibold basic-text">Basic</h3>
                            <p class="mt-2.5 text-sm basic-text">All the basic features that you need to manage your gym.
                            </p>

                            <div class="flex items-end mt-5">
                                <div class="flex items-start">
                                    <span class="text-xl font-medium basic-text"> Rp. </span>
                                    <p class="text-6xl font-medium tracking-tight basic-price">99k</p>
                                </div>
                                <span class="ml-0.5 text-lg basic-text"> / month </span>
                            </div>

                            <Link :href="link">
                            <a
                                class="inline-flex items-center justify-center w-full px-4 py-3 mt-6 font-semibold text-gray-900 transition-all duration-200 bg-transparent border-2 rounded-full basic-button">
                                Try This Out!
                            </a>
                            </Link>

                            <ul class="flex flex-col mt-8 space-y-4">
                                <li class="inline-flex items-center space-x-2">
                                    <svg class="flex-shrink-0 w-5 h-5 basic-icon" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-base font-medium basic-text"> 50 Maximum members</span>
                                </li>

                                <li class="inline-flex items-center space-x-2">
                                    <svg class="flex-shrink-0 w-5 h-5 basic-icon" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-base font-medium basic-text"> 10 Daily Transactions</span>
                                </li>

                                <li class="inline-flex items-center space-x-2">
                                    <svg class="flex-shrink-0 w-5 h-5 basic-icon" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-base font-medium basic-text"> Transaction Management </span>
                                </li>

                                <li class="inline-flex items-center space-x-2">
                                    <svg class="flex-shrink-0 w-5 h-5 basic-icon" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <strike class="text-base font-medium basic-text-dashed">Booking Personal
                                        Trainer</strike>
                                </li>

                                <li class="inline-flex items-center space-x-2">
                                    <svg class="flex-shrink-0 w-5 h-5 basic-icon" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <strike class="text-base font-medium basic-text-dashed"> Advanced Support </strike>
                                </li>
                            </ul>
                        </div>
                    </div>
                <!-- middle banner  -->
                <div
                    class="overflow-hidden ultimate-card border-2 border-transparent rounded-md shadow-xl hover:scale-105 ease-in-out duration-300">
                    <div class="p-6 md:py-8 md:px-9">
                        <h3 class="text-xl font-semibold ultimate-text">Ultimate</h3>
                        <p class="mt-2.5 text-sm ultimate-text">All the extended features to <strong>GREATLY</strong>
                            boost
                            your gym management.</p>

                        <div class="flex items-end mt-5">
                            <div class="flex items-start">
                                <span class="text-xl font-medium ultimate-text"> Rp. </span>
                                <p class="text-6xl font-medium tracking-tight ultimate-price">499k</p>
                            </div>
                            <span class="ml-0.5 text-lg ultimate-text"> / month </span>
                        </div>
                        <Link :href="link">
                        <a href="#" title=""
                            class="inline-flex items-center justify-center w-full px-4 py-3 mt-6 transition-all duration-200 border-2 border-transparent rounded-full ultimate-button"
                            role="">
                            Sign Up Now!
                        </a>
                        </Link>

                        <ul class="flex flex-col mt-8 space-y-4">
                            <li class="inline-flex items-center space-x-2">
                                <svg class="flex-shrink-0 w-5 h-5 ultimate-icon" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-base font-medium ultimate-text"> 500 Maximum members</span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg class="flex-shrink-0 w-5 h-5 ultimate-icon" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-base font-medium ultimate-text"> 125 Daily Transactions</span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg class="flex-shrink-0 w-5 h-5 ultimate-icon" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-base font-medium ultimate-text"> Transaction Management </span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg class="flex-shrink-0 w-5 h-5 ultimate-icon" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-base font-medium ultimate-text"> Booking Personal Trainer </span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg class="flex-shrink-0 w-5 h-5 ultimate-icon" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-base font-medium ultimate-text"> Premium Support </span>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- right banner  -->
                <div
                    class="overflow-hidden premium-card border-2 border-transparent rounded-md hover:scale-105 ease-in-out duration-300">
                    <div class="p-6 md:py-8 md:px-9">
                        <h3 class="text-xl font-semibold premium-text">Premium</h3>
                        <p class="mt-2.5 text-sm premium-text">All the premium features to boost your gym!</p>

                        <div class="flex items-end mt-5">
                            <div class="flex items-start">
                                <span class="text-xl font-medium premium-text"> Rp. </span>
                                <p class="text-6xl font-medium tracking-tight premium-price">249k</p>
                            </div>
                            <span class="ml-0.5 text-lg premium-text"> / month </span>
                        </div>

                        <Link :href="link"><a href="#" title=""
                            class="inline-flex items-center justify-center w-full px-4 py-3 mt-6 font-semibold transition-all duration-200 border-2 border-transparent rounded-full premium-button"
                            role="">
                            I Am Interested!
                        </a>
                        </Link>

                        <ul class="flex flex-col mt-8 space-y-4">
                            <li class="inline-flex items-center space-x-2">
                                <svg class="flex-shrink-0 w-5 h-5 premium-icon" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-base font-medium premium-text"> 200 Maximum members </span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg class="flex-shrink-0 w-5 h-5 premium-icon" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-base font-medium premium-text"> 50 Daily transactions </span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg class="flex-shrink-0 w-5 h-5 premium-icon" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-base font-medium premium-text"> Transaction Management </span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg class="flex-shrink-0 w-5 h-5 premium-icon" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-base font-medium premium-text"> Booking Personal Trainer </span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg class="flex-shrink-0 w-5 h-5 premium-icon" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-base font-medium premium-text"> Premium Support </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div v-if="isToggle" class="grid max-w-6xl grid-cols-1 gap-6 mx-auto sm:grid-cols-3 mt-14 md:gap-9">
                <!-- left banner -->
                <div class="overflow-hidden basic-card border-2 rounded-md hover:scale-105 ease-in-out duration-300">
                    <div class="p-6 md:py-8 md:px-9">
                        <h3 class="text-xl font-semibold basic-text">Basic</h3>
                        <p class="mt-2.5 text-sm basic-text">All the basic features that you need to manage your gym.
                        </p>

                        <div class="flex items-end mt-5">
                            <div class="flex items-start">
                                <span class="text-xl font-medium basic-text"> Rp. </span>
                                <p class="text-6xl font-medium tracking-tight basic-price">1.299k</p>
                            </div>
                            <span class="ml-0.5 text-lg basic-text"> / Year </span>
                        </div>

                        <Link :href="link"><a href="#" title=""
                            class="inline-flex items-center justify-center w-full px-4 py-3 mt-6 font-semibold text-gray-900 transition-all duration-200 bg-transparent border-2 rounded-full basic-button"
                            role="">
                            Try This Out!
                        </a>
                        </Link>

                        <ul class="flex flex-col mt-8 space-y-4">
                            <li class="inline-flex items-center space-x-2">
                                <svg class="flex-shrink-0 w-5 h-5 basic-icon" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-base font-medium basic-text"> 50 Maximum members</span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg class="flex-shrink-0 w-5 h-5 basic-icon" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-base font-medium basic-text"> 10 Daily Transactions</span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg class="flex-shrink-0 w-5 h-5 basic-icon" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-base font-medium basic-text"> Transaction Management </span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg class="flex-shrink-0 w-5 h-5 basic-icon" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <strike class="text-base font-medium basic-text-dashed">Booking Personal
                                    Trainer</strike>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg class="flex-shrink-0 w-5 h-5 basic-icon" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <strike class="text-base font-medium basic-text-dashed"> Advanced Support </strike>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- middle banner  -->
                <div
                    class="overflow-hidden ultimate-card border-2 border-transparent rounded-md shadow-xl hover:scale-105 ease-in-out duration-300">
                    <div class="p-6 md:py-8 md:px-9">
                        <h3 class="text-xl font-semibold ultimate-text">Ultimate</h3>
                        <p class="mt-2.5 text-sm ultimate-text">All the premium features to <strong>GREATLY</strong>
                            boost
                            your gym management.</p>

                        <div class="flex items-end mt-5">
                            <div class="flex items-start">
                                <span class="text-xl font-medium ultimate-text"> Rp. </span>
                                <p class="text-6xl font-medium tracking-tight ultimate-price">5.599k</p>
                            </div>
                            <span class="ml-0.5 text-lg ultimate-text"> / Year </span>
                        </div>

                        <Link :href="link"><a href="#" title=""
                            class="inline-flex items-center justify-center w-full px-4 py-3 mt-6 font-semibold text-white transition-all duration-200 border-2 border-transparent rounded-full ultimate-button"
                            role="">
                            Sign Up Now!
                        </a>
                        </Link>

                        <ul class="flex flex-col mt-8 space-y-4">
                            <li class="inline-flex items-center space-x-2">
                                <svg class="flex-shrink-0 w-5 h-5 ultimate-icon" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-base font-medium ultimate-text"> 500 Maximum members</span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg class="flex-shrink-0 w-5 h-5 ultimate-icon" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-base font-medium ultimate-text"> 125 Daily Transactions</span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg class="flex-shrink-0 w-5 h-5 ultimate-icon" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-base font-medium ultimate-text"> Transaction Management </span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg class="flex-shrink-0 w-5 h-5 ultimate-icon" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-base font-medium ultimate-text"> Booking Personal Trainer </span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg class="flex-shrink-0 w-5 h-5 ultimate-icon" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-base font-medium ultimate-text"> Premium Support </span>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- right banner  -->
                <div class="overflow-hidden premium-card rounded-md hover:scale-105 ease-in-out duration-300">
                    <div class="p-6 md:py-8 md:px-9">
                        <h3 class="text-xl font-semibold premium-text">Premium</h3>
                        <p class="mt-2.5 text-sm premium-text">All the premium features to boost your gym!</p>

                        <div class="flex items-end mt-5">
                            <div class="flex items-start">
                                <span class="text-xl font-medium premium-text"> Rp. </span>
                                <p class="text-6xl font-medium tracking-tight premium-price">3.699k</p>
                            </div>
                            <span class="ml-0.5 text-lg premium-text"> / Year </span>
                        </div>

                        <Link :href="link"><a href="#" title=""
                            class="inline-flex items-center justify-center w-full px-4 py-3 mt-6 font-semibold text-white transition-all duration-200 border-2 border-transparent rounded-full premium-button"
                            role="">
                            I Am Interested!
                        </a>
                        </Link>

                        <ul class="flex flex-col mt-8 space-y-4">
                            <li class="inline-flex items-center space-x-2">
                                <svg class="flex-shrink-0 w-5 h-5 premium-icon" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-base font-medium premium-text"> 200 Maximum members </span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg class="flex-shrink-0 w-5 h-5 premium-icon" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-base font-medium premium-text"> 50 Daily transactions </span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg class="flex-shrink-0 w-5 h-5 premium-icon" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-base font-medium premium-text"> Transaction Management </span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg class="flex-shrink-0 w-5 h-5 premium-icon" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-base font-medium premium-text"> Booking Personal Trainer </span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg class="flex-shrink-0 w-5 h-5 premium-icon" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-base font-medium premium-text"> Premium Support </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
