import { useForm } from "@inertiajs/vue3";
import { defineStore } from "pinia";

export const useMembershipRegisterStore = defineStore(
    "tenant_register_membership",
    () => {
        const formRequestRegistration = useForm({
            membershipPlanId: null,
            imageInvoiceUpload: null,
            fitnessGoal: "",
        });

        return { formRequestRegistration };
    },
);
