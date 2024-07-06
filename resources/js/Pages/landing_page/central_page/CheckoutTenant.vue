<script setup>
import { ref } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import SubscriptionInfo from "@components/central-pages/landingPage/SubscriptionInfo.vue";
import GymIcon from "/public/assets/images/icon/gym.png";
import FormatCurrency from "../../../Lib/Currency";
import FeatLists from "@components/ui/pricing-card/FeatLists.vue";

const items = { name: "Ultimate Subscription", duration: 6, price: 1000000 };
</script>

<style scoped>
.bord {
    @apply border-b-2 border-gray-300;
}
</style>

<template>
    <Head title="Checkout" />

    <div class="h-screen">
        <div class="grid lg:grid-cols-2 gap-4">
            <!-- user form -->
            <div></div>
            <!-- product info -->
            <div
                class="bg-primary-800 py-10 px-8 h-screen border-l border-surface-600"
            >
                <h2 class="text-3xl font-semibold mb-8">Order Summary</h2>
                <div
                    class="bg-primary-800 p-4 rounded-lg border border-surface-600"
                >
                    <ul class="flex flex-col gap-6">
                        <li class="flex flex-col gap-2 text-lg">
                            <span class="font-semibold">Purchase plan</span>
                            <span>Premium</span>
                        </li>
                        <li class="flex flex-col gap-2 text-lg">
                            <span class="font-semibold">Feature</span>
                            <FeatLists
                                class="!space-y-2 !mt-1"
                                list-class="!text-white"
                            />
                        </li>
                        <li class="flex flex-col gap-2 text-lg">
                            <span class="font-semibold">Period Type</span>
                            <span>Monthly</span>
                        </li>
                    </ul>
                </div>

                <hr class="my-8 border-t border-t-surface-600" />

                <ul class="flex flex-col gap-4">
                    <li class="flex justify-between gap-2 text-lg">
                        <span class="font-semibold">Price</span>
                        <span>{{ FormatCurrency(3000000) }}</span>
                    </li>
                    <li class="flex justify-between gap-2 text-lg">
                        <span class="font-semibold">Tax</span>
                        <span>10%</span>
                    </li>
                </ul>

                <ul class="mt-8">
                    <li class="flex justify-between gap-2 text-lg">
                        <span class="font-semibold">Total</span>
                        <span>{{ FormatCurrency(3540000) }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
