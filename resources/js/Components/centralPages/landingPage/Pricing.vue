<script setup>
    import { ref } from 'vue';

    import { Link } from '@inertiajs/vue3';

    const isToggle = ref(false);

    const togglePricing = () => {
        isToggle.value = !isToggle.value;
    };
</script>

<template>
    <section class="py-10 bg-gray-50 sm:py-16 lg:py-24">
        <div
            id="pricing"
            class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8"
        >
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="text-5xl font-bold leading-tight text-gray-600 sm:text-4xl lg:text-6xl">Pricing & Plans</h2>
                <p class="max-w-md mx-auto mt-4 text-base leading-relaxed text-gray-600">Here is lists of our pricing depending on what you need, either monthly or yearly</p>
            </div>

            <div class="mt-10">
                <div class="flex items-center justify-center space-x-2.5">
                    <span class="text-base font-medium text-gray-900"> Monthly </span>

                    <input
                        type="checkbox"
                        class="peer sr-only opacity-0"
                        id="toggle"
                    />
                    <label
                        @click="togglePricing"
                        for="toggle"
                        class="relative flex h-6 w-11 cursor-pointer items-center rounded-full bg-gray-400 px-0.5 outline-gray-400 transition-colors before:h-5 before:w-5 before:rounded-full before:bg-white before:shadow before:transition-transform before:duration-300 peer-checked:bg-violet-500 peer-checked:before:translate-x-full peer-focus-visible:outline peer-focus-visible:outline-offset-2 peer-focus-visible:outline-gray-400 peer-checked:peer-focus-visible:outline-violet-500"
                    >
                        <span class="sr-only">Enable</span>
                    </label>

                    <span class="text-base font-medium text-gray-900"> Yearly </span>
                </div>
            </div>

            <div
                v-if="!isToggle"
                class="grid max-w-6xl grid-cols-1 gap-6 mx-auto sm:grid-cols-3 mt-14 md:gap-9"
            >
                <!-- left banner  -->
                <div class="overflow-hidden bg-transparent border-2 border-gray-200 rounded-md hover:scale-105 ease-in-out duration-300">
                    <div class="p-6 md:py-8 md:px-9">
                        <h3 class="text-xl font-semibold text-black">Basic</h3>
                        <p class="mt-2.5 text-sm text-gray-600">All the basic features that you need to manage your gym.</p>

                        <div class="flex items-end mt-5">
                            <div class="flex items-start">
                                <span class="text-xl font-medium text-black"> Rp. </span>
                                <p class="text-6xl font-medium tracking-tight text-slate-800">99k</p>
                            </div>
                            <span class="ml-0.5 text-lg text-gray-600"> / month </span>
                        </div>

                        <a
                            href="#"
                            title=""
                            class="inline-flex items-center justify-center w-full px-4 py-3 mt-6 font-semibold text-gray-900 transition-all duration-200 bg-transparent border-2 rounded-full border-fuchsia-600 hover:bg-fuchsia-600 hover:text-white focus:text-white focus:bg-fuchsia-600"
                            role=""
                        >
                            Try This Out!
                        </a>

                        <ul class="flex flex-col mt-8 space-y-4">
                            <li class="inline-flex items-center space-x-2">
                                <svg
                                    class="flex-shrink-0 w-5 h-5 text-gray-400"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <span class="text-base font-medium text-gray-900"> 50 Maximum members</span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg
                                    class="flex-shrink-0 w-5 h-5 text-gray-400"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <span class="text-base font-medium text-gray-900"> 10 Daily Transactions</span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg
                                    class="flex-shrink-0 w-5 h-5 text-gray-400"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <span class="text-base font-medium text-gray-900"> Transaction Management </span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg
                                    class="flex-shrink-0 w-5 h-5 text-gray-400"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <strike class="text-base font-medium text-gray-400">Booking Personal Trainer</strike>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg
                                    class="flex-shrink-0 w-5 h-5 text-gray-400"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <strike class="text-base font-medium text-gray-400"> Advanced Support </strike>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- middle banner  -->
                <div class="overflow-hidden bg-blue-400 border-2 border-transparent rounded-md shadow-xl hover:scale-105 ease-in-out duration-300">
                    <div class="p-6 md:py-8 md:px-9">
                        <h3 class="text-xl font-semibold text-black">Premium</h3>
                        <p class="mt-2.5 text-sm text-black">All the extended features to <strong>GREATLY</strong> boost your gym management.</p>

                        <div class="flex items-end mt-5">
                            <div class="flex items-start">
                                <span class="text-xl font-medium text-black"> Rp. </span>
                                <p class="text-6xl font-medium tracking-tight">499k</p>
                            </div>
                            <span class="ml-0.5 text-lg text-black"> / month </span>
                        </div>

                        <a
                            href="#"
                            title=""
                            class="inline-flex items-center justify-center w-full px-4 py-3 mt-6 font-semibold text-white transition-all duration-200 border-2 border-transparent rounded-full bg-gradient-to-r from-blue-600 to-fuchsia-600 hover:opacity-80 focus:opacity-80"
                            role=""
                        >
                            Sign Up Now!
                        </a>

                        <ul class="flex flex-col mt-8 space-y-4">
                            <li class="inline-flex items-center space-x-2">
                                <svg
                                    class="flex-shrink-0 w-5 h-5 text-white"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <span class="text-base font-medium text-gray-900"> 500 Maximum members</span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg
                                    class="flex-shrink-0 w-5 h-5 text-white"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <span class="text-base font-medium text-gray-900"> 125 Daily Transactions</span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg
                                    class="flex-shrink-0 w-5 h-5 text-white"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <span class="text-base font-medium text-gray-900"> Transaction Management </span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg
                                    class="flex-shrink-0 w-5 h-5 text-white"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <span class="text-base font-medium text-gray-900"> Booking Personal Trainer </span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg
                                    class="flex-shrink-0 w-5 h-5 text-white"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <span class="text-base font-medium text-gray-900"> Premium Support </span>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- right banner  -->
                <div class="overflow-hidden bg-blue-200 border-2 border-transparent rounded-md hover:scale-105 ease-in-out duration-300">
                    <div class="p-6 md:py-8 md:px-9">
                        <h3 class="text-xl font-semibold text-black">Premium</h3>
                        <p class="mt-2.5 text-sm text-gray-600">All the premium features to boost your gym!</p>

                        <div class="flex items-end mt-5">
                            <div class="flex items-start">
                                <span class="text-xl font-medium text-black"> Rp. </span>
                                <p class="text-6xl font-medium tracking-tight text-gray-800">249k</p>
                            </div>
                            <span class="ml-0.5 text-lg text-gray-600"> / month </span>
                        </div>

                        <a
                            href="#"
                            title=""
                            class="inline-flex items-center justify-center w-full px-4 py-3 mt-6 font-semibold text-white transition-all duration-200 border-2 border-transparent rounded-full bg-gradient-to-r from-indigo-900 to-blue-600 hover:opacity-80 focus:opacity-80"
                            role=""
                        >
                            I Am Interested!
                        </a>

                        <ul class="flex flex-col mt-8 space-y-4">
                            <li class="inline-flex items-center space-x-2">
                                <svg
                                    class="flex-shrink-0 w-5 h-5 text-gray-400"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <span class="text-base font-medium text-gray-900"> 200 Maximum members </span>
                                <svg
                                    class="w-4 h-4 ml-0.5 text-gray-500"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                </svg>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg
                                    class="flex-shrink-0 w-5 h-5 text-gray-400"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <span class="text-base font-medium text-gray-900"> 50 Daily transactions </span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg
                                    class="flex-shrink-0 w-5 h-5 text-gray-400"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <span class="text-base font-medium text-gray-900"> Transaction Management </span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg
                                    class="flex-shrink-0 w-5 h-5 text-gray-400"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <span class="text-base font-medium text-gray-900"> Booking Personal Trainer </span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg
                                    class="flex-shrink-0 w-5 h-5 text-gray-400"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <span class="text-base font-medium text-gray-900"> Premium Support </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div
                v-if="isToggle"
                class="grid max-w-6xl grid-cols-1 gap-6 mx-auto sm:grid-cols-3 mt-14 md:gap-9"
            >
                <!-- left banner -->
                <div class="overflow-hidden bg-transparent border-2 border-indigo-400 rounded-md hover:scale-105 ease-in-out duration-300">
                    <div class="p-6 md:py-8 md:px-9">
                        <h3 class="text-xl font-semibold text-black">Basic</h3>
                        <p class="mt-2.5 text-sm text-gray-600">All the basic features that you need to manage your gym.</p>

                        <div class="flex items-end mt-5">
                            <div class="flex items-start">
                                <span class="text-xl font-medium text-black"> Rp. </span>
                                <p class="text-6xl font-medium tracking-tight text-slate-800">1.299k</p>
                            </div>
                            <span class="ml-0.5 text-lg text-gray-600"> / Year </span>
                        </div>

                        <a
                            href="#"
                            title=""
                            class="inline-flex items-center justify-center w-full px-4 py-3 mt-6 font-semibold text-gray-900 transition-all duration-200 bg-transparent border-2 rounded-full border-fuchsia-600 hover:bg-fuchsia-600 hover:text-white focus:text-white focus:bg-fuchsia-600"
                            role=""
                        >
                            Try This Out!
                        </a>

                        <ul class="flex flex-col mt-8 space-y-4">
                            <li class="inline-flex items-center space-x-2">
                                <svg
                                    class="flex-shrink-0 w-5 h-5 text-gray-400"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <span class="text-base font-medium text-gray-900"> 50 Maximum members</span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg
                                    class="flex-shrink-0 w-5 h-5 text-gray-400"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <span class="text-base font-medium text-gray-900"> 10 Daily Transactions</span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg
                                    class="flex-shrink-0 w-5 h-5 text-gray-400"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <span class="text-base font-medium text-gray-900"> Transaction Management </span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg
                                    class="flex-shrink-0 w-5 h-5 text-gray-400"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <strike class="text-base font-medium text-gray-400">Booking Personal Trainer</strike>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg
                                    class="flex-shrink-0 w-5 h-5 text-gray-400"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <strike class="text-base font-medium text-gray-400"> Advanced Support </strike>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- middle banner  -->
                <div class="overflow-hidden bg-indigo-400 border-2 border-transparent rounded-md shadow-xl hover:scale-105 ease-in-out duration-300">
                    <div class="p-6 md:py-8 md:px-9">
                        <h3 class="text-xl font-semibold text-black">Ultimate</h3>
                        <p class="mt-2.5 text-sm text-black">All the premium features to <strong>GREATLY</strong> boost your gym management.</p>

                        <div class="flex items-end mt-5">
                            <div class="flex items-start">
                                <span class="text-xl font-medium text-black"> Rp. </span>
                                <p class="text-6xl font-medium tracking-tight">5.599k</p>
                            </div>
                            <span class="ml-0.5 text-lg text-black"> / Year </span>
                        </div>

                        <a
                            href="#"
                            title=""
                            class="inline-flex items-center justify-center w-full px-4 py-3 mt-6 font-semibold text-white transition-all duration-200 border-2 border-transparent rounded-full bg-gradient-to-r from-blue-600 to-fuchsia-600 hover:opacity-80 focus:opacity-80"
                            role=""
                        >
                            Sign Up Now!
                        </a>

                        <ul class="flex flex-col mt-8 space-y-4">
                            <li class="inline-flex items-center space-x-2">
                                <svg
                                    class="flex-shrink-0 w-5 h-5 text-white"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <span class="text-base font-medium text-gray-900"> 500 Maximum members</span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg
                                    class="flex-shrink-0 w-5 h-5 text-white"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <span class="text-base font-medium text-gray-900"> 125 Daily Transactions</span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg
                                    class="flex-shrink-0 w-5 h-5 text-white"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <span class="text-base font-medium text-gray-900"> Transaction Management </span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg
                                    class="flex-shrink-0 w-5 h-5 text-white"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <span class="text-base font-medium text-gray-900"> Booking Personal Trainer </span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg
                                    class="flex-shrink-0 w-5 h-5 text-white"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <span class="text-base font-medium text-gray-900"> Premium Support </span>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- right banner  -->
                <div class="overflow-hidden bg-indigo-200 border-2 border-indigo-600 rounded-md hover:scale-105 ease-in-out duration-300">
                    <div class="p-6 md:py-8 md:px-9">
                        <h3 class="text-xl font-semibold text-black">Premium</h3>
                        <p class="mt-2.5 text-sm text-gray-600">All the premium features to boost your gym!</p>

                        <div class="flex items-end mt-5">
                            <div class="flex items-start">
                                <span class="text-xl font-medium text-black"> Rp. </span>
                                <p class="text-6xl font-medium tracking-tight text-gray-800">3.699k</p>
                            </div>
                            <span class="ml-0.5 text-lg text-gray-600"> / Year </span>
                        </div>

                        <a
                            href="#"
                            title=""
                            class="inline-flex items-center justify-center w-full px-4 py-3 mt-6 font-semibold text-white transition-all duration-200 border-2 border-transparent rounded-full bg-gradient-to-r from-indigo-900 to-blue-600 hover:opacity-80 focus:opacity-80"
                            role=""
                        >
                            I Am Interested!
                        </a>

                        <ul class="flex flex-col mt-8 space-y-4">
                            <li class="inline-flex items-center space-x-2">
                                <svg
                                    class="flex-shrink-0 w-5 h-5 text-gray-400"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <span class="text-base font-medium text-gray-900"> 200 Maximum members </span>
                                <svg
                                    class="w-4 h-4 ml-0.5 text-gray-500"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                </svg>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg
                                    class="flex-shrink-0 w-5 h-5 text-gray-400"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <span class="text-base font-medium text-gray-900"> 50 Daily transactions </span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg
                                    class="flex-shrink-0 w-5 h-5 text-gray-400"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <span class="text-base font-medium text-gray-900"> Transaction Management </span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg
                                    class="flex-shrink-0 w-5 h-5 text-gray-400"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <span class="text-base font-medium text-gray-900"> Booking Personal Trainer </span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg
                                    class="flex-shrink-0 w-5 h-5 text-gray-400"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <span class="text-base font-medium text-gray-900"> Premium Support </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
