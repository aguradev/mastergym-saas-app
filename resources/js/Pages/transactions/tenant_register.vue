<script setup>
import PrimaryButton from "@components/elements/button/PrimaryButton.vue";
import { Head, usePage } from "@inertiajs/vue3";
import { ref, watchEffect } from "vue";
import { route } from "ziggy-js";
import { useToast } from "primevue/usetoast";
import Toast from "primevue/toast";
import { useTenantRegistration } from "@stores/tenant_registration_state";
import { storeToRefs } from "pinia";

const page = usePage();
const toast = useToast();
const tenantRegistrationState = useTenantRegistration();
const { formRegister, tenantRegistrationStepForm, tenantFormActive } =
    storeToRefs(tenantRegistrationState);

const isFormSubmmited = ref(false);
const submitBtnLabel = ref("Submit");

const registerTenantHandler = () => {
    isFormSubmmited.value = true;
    submitBtnLabel.value = "Loading...";

    formRegister.value.post(
        route("transaction.tenant-registration.submit", {
            token: page.props?.token,
        }),
        {
            onFinish: () => {
                isFormSubmmited.value = false;
                submitBtnLabel.value = "Submit";
            },
            onError: () => {
                tenantFormActive.value = tenantRegistrationStepForm.value[0];
            },
        },
    );
};

watchEffect(() => {
    const { message_error } = page.props?.flash;

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
    <Head title="Tenant Registration" />
    <div>
        <Toast />
        <section
            class="place-content-center py-16 min-h-screen px-8 max-w-[1000px] mx-auto"
        >
            <form
                action="#"
                autocomplete="off"
                @submit.prevent="registerTenantHandler"
            >
                <div
                    v-for="(form, i) in tenantRegistrationStepForm"
                    :key="form.id"
                >
                    <div v-show="form.id === tenantFormActive?.id">
                        <h3 class="font-bold text-3xl text-center mb-14">
                            {{ form.title }}
                        </h3>
                        <component :is="form.component" />
                    </div>
                </div>

                <div
                    class="mt-12 flex gap-4 justify-between"
                    v-if="
                        tenantFormActive.id ===
                        tenantRegistrationStepForm[
                            tenantRegistrationStepForm.length - 1
                        ].id
                    "
                >
                    <PrimaryButton
                        type="button"
                        label="Prev"
                        class="px-8 !py-3"
                        @click-event="
                            () =>
                                tenantRegistrationState.updateStepFormPosition(
                                    'PREV_FORM',
                                )
                        "
                    />
                    <PrimaryButton
                        :label="submitBtnLabel"
                        type="submit"
                        :disabled="isFormSubmmited"
                        class="!px-12"
                    />
                </div>
                <div v-else class="mt-12">
                    <PrimaryButton
                        type="button"
                        label="Next"
                        class="ml-auto px-8 !py-3"
                        @click-event="
                            () =>
                                tenantRegistrationState.updateStepFormPosition(
                                    'NEXT_FORM',
                                )
                        "
                    />
                </div>
            </form>
        </section>
    </div>
</template>
