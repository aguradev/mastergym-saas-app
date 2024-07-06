<script setup>
import { Head, Link } from "@inertiajs/vue3";
import FormatCurrency from "../../../Lib/Currency";
import FeatLists from "@components/ui/pricing-card/FeatLists.vue";
import CheckoutForm from "@components/central-pages/transcation-forms/CheckoutForm.vue";
import PrimaryButton from "@components/elements/button/PrimaryButton.vue";
import CardRadio from "@components/elements/input/CardRadio.vue";
import { ref } from "vue";

const { planOrder, totalPrice, price, periodPurchase } = defineProps([
    "planOrder",
    "totalPrice",
    "price",
    "periodPurchase",
]);

const manualTransferSelected = ref(false);
const paymentGatewaySelected = ref(false);

const selectRadioPaymentHandler = (radio) => {
    switch (radio.id) {
        case "manual_transfer":
            manualTransferSelected.value = true;
            paymentGatewaySelected.value = false;
            break;
        case "payment_gateway":
            paymentGatewaySelected.value = true;
            manualTransferSelected.value = false;
            break;
        default:
            paymentGatewaySelected.value = false;
            manualTransferSelected.value = false;
            break;
    }
};
</script>

<template>
    <Head title="Checkout" />

    <div class="min-h-screen">
        <div class="grid lg:grid-cols-2 gap-4">
            <!-- user form -->
            <div class="py-10 px-12">
                <action autocomplete="off">
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold mb-8">
                            Billing Infomation
                        </h2>
                        <CheckoutForm />
                    </div>
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold mb-8">
                            Select Payment
                        </h2>
                        <CardRadio
                            radio-name="select_payment"
                            radio-id="payment_gateway"
                            label="Payment Gateway"
                            @checked-radio-handler="selectRadioPaymentHandler"
                            :payment-select="paymentGatewaySelected"
                        />
                        <CardRadio
                            radio-name="select_payment"
                            radio-id="manual_transfer"
                            label="Manual Transfer"
                            @checked-radio-handler="selectRadioPaymentHandler"
                            :payment-select="manualTransferSelected"
                        />
                    </div>
                    <PrimaryButton
                        label="Confirm Order"
                        class="w-full"
                        type="submit"
                    />
                </action>
            </div>
            <!-- product info -->
            <div
                class="bg-primary-800 py-10 px-8 min-h-screen border-l border-surface-600"
            >
                <h2 class="text-3xl font-semibold mb-8">Order Summary</h2>
                <div
                    class="bg-primary-800 p-6 rounded-lg border border-surface-600"
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
