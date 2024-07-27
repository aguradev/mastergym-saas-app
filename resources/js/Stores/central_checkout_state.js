import { useForm } from "@inertiajs/vue3";
import { defineStore } from "pinia";
import { ref } from "vue";

export const useCentralCheckout = defineStore("central-checkout-state", () => {
    const checkoutOrderRequest = useForm({
        full_name: "",
        email: "",
        phone_number: null,
        address: null,
        select_payment: "",
    });

    const checkoutOrderMessageValidation = ref(null);

    return { checkoutOrderRequest, checkoutOrderMessageValidation };
});
