<script setup>
    import { ref, reactive, watch } from 'vue';
    import { Head, router } from '@inertiajs/vue3';

    const form = reactive({
        full_name: null,
        username: null,
        email: null,
        password: null,
        confirm_password: null,
    });

    const passwordMatch = ref(false);
    const validEmail = ref(false);
    const validPassword = ref(false);
    const passlen = ref(0);

    function isValidEmail(email) {
        const emailRegex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return emailRegex.test(email);
    }

    function isValidPassword(pass) {
        return pass.length;
    }

    watch(form, () => {
        try {
            validEmail.value = isValidEmail(form.email);
            passlen.value = isValidPassword(form.password);
        } catch (e) {
            console.log(e);
        }

        if (form.confirm_password == form.password) {
            passwordMatch.value = true;
        } else if (passlen.value >= 8) {
            validPassword.value = true;
        } else {
            passwordMatch.value = false;
        }
    });

    function submit() {
        router.post('/users', form);
    }
</script>

<style scoped>
    .input-field {
        @apply w-full rounded-md border-2 border-[#a1a1a1] bg-white py-3 px-6 text-base font-medium text-[#2a2d32] outline-none focus:border-[#6A64F1] focus:shadow-md;
    }
</style>

<template>
    <Head title="Sign-Up" />

    <!-- component -->
    <div class="h-screen md:flex">
        <div class="relative overflow-hidden md:flex w-1/2 bg-gradient-to-tr from-blue-900 to-blue-500 i justify-around items-center hidden">
            <div>
                <h1 class="text-white font-bold text-4xl font-sans">Gym Master</h1>
                <p class="text-white mt-1">The Most Reliable Gym Management Service</p>
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
        <div class="flex md:w-1/2 justify-center items-center bg-white h-screen">
            <form
                @submit.prevent="submit"
                class="bg-white w-[600px] mx-10 sm:px-20"
            >
                <h1 class="text-gray-800 font-bold text-3xl mb-1 mt-10">Register Your Account!</h1>
                <p class="text-sm font-normal text-gray-600 mb-10">The first of few simple steps to get your app running!</p>
                <div class="w-full">
                    <div class="mb-5">
                        <input
                            type="text"
                            id="full_name"
                            placeholder="Full Name"
                            class="input-field"
                            v-model="form.full_name"
                        />
                    </div>
                </div>
                <div class="w-full">
                    <div class="mb-5">
                        <input
                            type="text"
                            id="username"
                            placeholder="Username"
                            class="input-field"
                            v-model="form.username"
                        />
                    </div>
                </div>
                <div class="w-full">
                    <div class="mb-5">
                        <input
                            type="text"
                            id="email"
                            placeholder="Email Address"
                            class="input-field"
                            v-model="form.email"
                        />
                        <p
                            v-if="form.email != null && validEmail == false"
                            class="text-red-800"
                        >
                            please put in a valid email
                        </p>
                    </div>
                    <p></p>
                </div>

                <div class="text-black pt-5 text-center"></div>
                <button
                    type="submit"
                    class="block w-full bg-indigo-600 mt-2 text-md sm:text-md py-4 rounded-2xl text-white font-semibold mb-2 tracking-wider"
                >
                    CREATE YOUR ACCOUNT!
                </button>
            </form>
        </div>
    </div>
</template>
