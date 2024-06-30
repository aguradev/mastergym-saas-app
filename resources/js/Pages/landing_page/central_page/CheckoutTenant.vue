<script setup>
import { ref } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import SubscriptionInfo from "@components/central-pages/landingPage/SubscriptionInfo.vue";
import GymIcon from "/public/assets/images/icon/gym.png";

const items = { name: "Ultimate Subscription", duration: 6, price: 1000000 };
</script>

<style scoped>
.bord {
    @apply border-b-2 border-gray-300;
}
</style>

<template>

    <Head title="Payment Page" />
    <div class="absolute p-10 hidden md:block flex">
        <img :src="GymIcon" alt="gym logo" class="w-[70px] inline-block" />
    </div>
    <form @submit.prevent="submit">
        <div id="background_drop"
            class="w-screen h-screen bg-[url('/public/storage/images/svg/stacked-waves-haikei2.svg')] flex justify-center py-10">
            <div class="card shadow-xl bg-white flex-row w-11/12 md:w-2/5 rounded-2xl text-black p-5">
                <div id="title"
                    class="bg-blue-400 shadow-md border-b-4 border-blue-200 rounded-xl h-1/6 text-center pt-7 md:pt-9">
                    <p class="text-3xl font-semibold drop-shadow-md text-white">
                        Gym Master - Payment
                    </p>
                </div>
                <div id="user" class="h-1/6 p-5 leading-6 bord">
                    <p class="text-xl font-medium">Michael Jackson Gumembert</p>
                    <p>useremail@gmail.com</p>
                </div>

                <SubscriptionInfo :name="items.name" :duration="items.duration" :price="items.price" id="subscription"
                    class="h-2/6 bord">
                </SubscriptionInfo>
                <div id="title" class="h-1/6 text-start pt-3 md:pt-8 px-2 md:px-10 bord">
                    <div>
                        <input class="inline-block mr-2" type="checkbox" />
                        <label class="text-sm">I Confirm that the information displayed above is
                            true.</label>
                    </div>
                    <div>
                        <input class="inline-block mr-2" type="checkbox" />
                        <label class="text-sm">I Agree to the Terms and Condition of the Gym
                            Master Service</label>
                    </div>
                </div>
                <div id="payment" class="flex justify-center items-center h-1/6">
                    <Link href=""
                        class="inline-block shadow-xl rounded-md font-medium text-white bg-green-500 py-2 px-5 md:px-10 h-fit">
                    Proceed to the Payment Process</Link>
                </div>
            </div>
        </div>
    </form>
</template>
