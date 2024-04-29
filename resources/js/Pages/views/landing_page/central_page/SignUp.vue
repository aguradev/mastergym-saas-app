<script setup>
    import { ref } from 'vue';
    import { Head } from '@inertiajs/vue3';
    import MainNavLayout from '@/layouts/MainNavLayout.vue';
</script>
<template>
    <MainNavLayout>
        <Head title="Sign-Up" />
    </MainNavLayout>
    <!-- component -->
    <div class="h-screen md:flex">
        <div class="relative overflow-hidden md:flex w-1/2 bg-gradient-to-tr from-blue-900 to-blue-500 i justify-around items-center hidden">
            <div>
                <h1 class="text-white font-bold text-4xl font-sans">Gym Master</h1>
                <p class="text-white mt-1">The most popular</p>
                <button
                    type="submit"
                    class="block w-28 bg-white text-indigo-800 mt-4 py-2 rounded-2xl font-bold mb-2"
                >
                    Read More
                </button>
            </div>
            <div class="absolute -bottom-32 -left-40 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
            <div class="absolute -bottom-40 -left-20 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
            <div class="absolute -top-40 -right-0 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
            <div class="absolute -top-20 -right-20 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
        </div>
        <div class="flex md:w-1/2 justify-center py-5 items-center bg-white">
            <form class="bg-white w-[600px] px-20">
                <h1 class="text-gray-800 font-bold text-2xl mb-1 mt-20">Register Your Account!</h1>
                <p class="text-sm font-normal text-gray-600 mb-7">The first of few simple steps to get your app running!</p>
                <div class="w-full">
                    <div class="mb-5">
                        <input
                            type="text"
                            name="fName"
                            id="fName"
                            placeholder="Full Name"
                            class="w-full rounded-md border-2 border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                        />
                    </div>
                </div>
                <div class="w-full">
                    <div class="mb-5">
                        <input
                            type="text"
                            name="uName"
                            id="uName"
                            placeholder="Username"
                            class="w-full rounded-md border-2 border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                        />
                    </div>
                </div>
                <div class="w-full">
                    <div class="mb-5">
                        <input
                            type="text"
                            name="email"
                            id="email"
                            placeholder="Email Address"
                            class="w-full rounded-md border-2 border-[lightgray] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                        />
                    </div>
                </div>
                <div class="w-full">
                    <div class="mb-5">
                        <input
                            type="password"
                            name="pass"
                            id="pass"
                            placeholder="Password"
                            class="w-full rounded-md border-2 border-[lightgray] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                        />
                    </div>
                </div>
                <div class="w-full">
                    <div class="mb-5">
                        <input
                            type="Password"
                            name="cPass"
                            id="cPass"
                            placeholder="Confirmation Password"
                            class="w-full rounded-md border-2 border-[lightgray] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                        />
                    </div>
                </div>
                <div class="text-black pt-5 text-center">
                    <p>
                        Already have an account?
                        <a
                            class="font-medium text-blue-600"
                            href="/login"
                            >Login Here!</a
                        >
                    </p>
                </div>
                <button
                    type="submit"
                    class="block w-full bg-indigo-600 mt-2 py-4 rounded-2xl text-white font-semibold mb-2 tracking-wider"
                >
                    CREATE YOUR ACCOUNT
                </button>
            </form>
        </div>
    </div>
</template>
