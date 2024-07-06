import { useForm } from "@inertiajs/vue3";
import { defineStore } from "pinia";

export const useCentralCheckout = defineStore("central-checkout-state", () => {
    const checkoutOrderRequest = useForm({
        full_name: "",
        email: "",
        phone_number: null,
        address: null,
        select_payment: "",
    });

    return { checkoutOrderRequest };
});
