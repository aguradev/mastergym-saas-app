<script setup>
import { ref, toRef } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import FormatCurrency from "../../../Lib/Currency";
import FeatLists from "@components/ui/pricing-card/FeatLists.vue";

const { planOrder, totalPrice, price, periodPurchase } = defineProps([
    "planOrder",
    "totalPrice",
    "price",
    "periodPurchase",
]);
</script>

<template>
    <Head title="Checkout" />

    <div class="min-h-screen">
        <div class="grid lg:grid-cols-2 gap-4">
            <!-- user form -->
            <div></div>
            <!-- product info -->
            <div
                class="bg-primary-800 py-10 px-8 min-h-screen border-l border-surface-600"
            >
                <h2 class="text-3xl font-semibold mb-8">Order Summary</h2>
                <div
                    class="bg-primary-800 p-6 rounded-lg border border-surface-600 max-w-fit"
                >
                    <ul class="flex flex-col gap-6">
                        <li class="flex flex-col gap-2 text-lg">
                            <span class="font-semibold">Purchase plan</span>
                            <span>{{ planOrder?.name }}</span>
                        </li>
                        <li class="flex flex-col gap-2 text-lg">
                            <span class="font-semibold">Feature</span>
                            <FeatLists
                                :feature-lists="
                                    planOrder.tenant_version_latest
                                        .plan_features
                                "
                                class="!space-y-4 !mt-1"
                                list-class="!text-white"
                            />
                        </li>
                        <li class="flex flex-col gap-2 text-lg">
                            <span class="font-semibold">Period Type</span>
                            <span>{{ periodPurchase }}</span>
                        </li>
                    </ul>
                </div>

                <hr class="my-8 border-t border-t-surface-600" />

                <ul class="flex flex-col gap-4">
                    <li class="flex justify-between gap-2 text-lg">
                        <span class="font-semibold">Price</span>
                        <span>{{ FormatCurrency(price) }}</span>
                    </li>
                    <li class="flex justify-between gap-2 text-lg">
                        <span class="font-semibold">Tax</span>
                        <span>10%</span>
                    </li>
                </ul>

                <ul class="mt-8">
                    <li class="flex justify-between gap-2 text-lg">
                        <span class="font-semibold">Total</span>
                        <span>{{ FormatCurrency(totalPrice) }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
