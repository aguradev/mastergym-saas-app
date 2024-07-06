<script setup>
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import FormatCurrency from "../../../Lib/Currency";
import FeatLists from "@components/ui/pricing-card/FeatLists.vue";
import CheckoutForm from "@components/central-pages/transcation-forms/CheckoutForm.vue";
import PrimaryButton from "@components/elements/button/PrimaryButton.vue";
import CardRadio from "@components/elements/input/CardRadio.vue";
import { ref, watchEffect } from "vue";
import { useCentralCheckout } from "@stores/central_checkout_state";
import { storeToRefs } from "pinia";
import { route } from "ziggy-js";
import { useToast } from "primevue/usetoast";
import Toast from "primevue/toast";

const { planOrder, totalPrice, price, periodPurchase } = defineProps([
    "planOrder",
    "totalPrice",
    "price",
    "periodPurchase",
]);

const useCentralCheckoutState = useCentralCheckout();
const { checkoutOrderRequest } = storeToRefs(useCentralCheckoutState);
const toast = useToast();
const page = usePage();

const isFormSubmmited = ref(false);
const submitBtnLabel = ref("Confirm Order");
const manualTransferSelected = ref(false);
const paymentGatewaySelected = ref(false);

const selectRadioPaymentHandler = (radio) => {
    switch (radio.id) {
        case "manual_transfer":
            manualTransferSelected.value = true;
            paymentGatewaySelected.value = false;
            checkoutOrderRequest.value.select_payment = radio.value;
            break;
        case "payment_gateway":
            paymentGatewaySelected.value = true;
            manualTransferSelected.value = false;
            checkoutOrderRequest.value.select_payment = radio.value;
            break;
        default:
            paymentGatewaySelected.value = false;
            manualTransferSelected.value = false;
            break;
    }
};

const confirmOrderActionHandler = () => {
    submitBtnLabel.value = "Loading...";
    isFormSubmmited.value = true;

    checkoutOrderRequest.value.post(route("transaction.confirm-order"), {
        onFinish: () => {
            submitBtnLabel.value = "Confirm Order";
            isFormSubmmited.value = false;
        },
    });
};

watchEffect(() => {
    const { message_success, message_error } = page.props.flash;

    if (message_success) {
        toast.add({
            severity: "success",
            summary: "info",
            detail: message_success,
            life: 3000,
        });
    }

    if (message_error) {
        toast.add({
            severity: "error",
            summary: "info",
            detail: message_error,
            life: 3000,
        });
    }
});
</script>

<template>
    <Head title="Checkout" />

    <div class="min-h-screen">
        <Toast />
        <div class="grid lg:grid-cols-2 gap-4">
            <!-- user form -->
            <div class="py-10 px-12">
                <form
                    autocomplete="off"
                    @submit.prevent="confirmOrderActionHandler"
                >
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
                        :label="submitBtnLabel"
                        :disabled="isFormSubmmited"
                        class="w-full"
                        type="submit"
                    />
                </form>
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
