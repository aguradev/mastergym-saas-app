import { defineStore } from "pinia";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import TenantDataForm from "@components/central-pages/transcation-forms/TenantDataForm.vue";
import TenantUserForm from "@components/central-pages/transcation-forms/TenantUserForm.vue";

export const useTenantRegistration = defineStore("tenant-registrations", () => {
    const formRegister = useForm({
        gym_title: null,
        domain: null,
        gym_email: null,
        address: null,
        first_name: null,
        last_name: null,
        user_email: null,
        password: null,
        password_confirmation: null,
    });

    const tenantRegistrationStepForm = ref([
        {
            id: 1,
            title: "Tenant Registration",
            component: TenantDataForm,
        },
        {
            id: 2,
            title: "Tenant Super Admin Account",
            component: TenantUserForm,
        },
    ]);

    const tenantFormActive = ref(tenantRegistrationStepForm.value[0]);
    const updateStepFormPosition = (ACTION_TYPE) => {
        const findPosition = tenantRegistrationStepForm.value.findIndex(
            (form) => form.id === tenantFormActive.value.id,
        );

        if (findPosition >= 0) {
            switch (ACTION_TYPE) {
                case "NEXT_FORM":
                    tenantFormActive.value =
                        tenantRegistrationStepForm.value[findPosition + 1];
                    break;
                case "PREV_FORM":
                    tenantFormActive.value =
                        tenantRegistrationStepForm.value[findPosition - 1];
                    break;
                default:
                    break;
            }
        }
    };

    return {
        formRegister,
        tenantRegistrationStepForm,
        tenantFormActive,
        updateStepFormPosition,
    };
});
