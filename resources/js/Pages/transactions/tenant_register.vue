<script setup>
import InputText from "@components/elements/input/InputText.vue";
import InputGroup from "@components/ui/group/InputGroup.vue";
import PrimaryButton from "@components/elements/button/PrimaryButton.vue";
import InputPassword from "@components/elements/input/InputPassword.vue";
import InputTextArea from "@components/elements/input/InputTextArea.vue";
import ValidationMessage from "@components/ui/cta/ValidationMessage.vue";
import { Head, usePage } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";
import { ref, watchEffect } from "vue";
import { route } from "ziggy-js";
import { useToast } from "primevue/usetoast";
import Toast from "primevue/toast";

const page = usePage();
const toast = useToast();

const formRegister = useForm({
    gym_title: null,
    domain: null,
    email: null,
    address: null,
    password: null,
    password_confirmation: null,
});

const isFormSubmmited = ref(false);
const submitBtnLabel = ref("Registration");

const registerTenantHandler = () => {
    isFormSubmmited.value = true;
    submitBtnLabel.value = "Loading...";

    formRegister.post(route("transaction.tenant-registration.submit"), {
        onFinish: () => {
            isFormSubmmited.value = false;
            submitBtnLabel.value = "Registration";
        },
        onSuccess: () => {
            formRegister.reset();
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
    <Head title="Tenant registration" />
    <div>
        <Toast />
        <section
            class="bg-primary-800 border-r border-l place-content-center py-16 border-surface-700 min-h-screen px-8 max-w-[1000px] mx-auto"
        >
            <h3 class="font-bold text-3xl text-center mb-14">
                Tenant registration
            </h3>

            <form
                action="#"
                autocomplete="off"
                @submit.prevent="registerTenantHandler"
            >
                <div class="grid lg:grid-cols-2 gap-5">
                    <InputGroup label="Gym title" labelFor="gym-title-input">
                        <InputText
                            inputId="gym-title-input"
                            inputPlaceholder="typing title"
                            inputName="gym_title_input"
                            v-model:inputValue="formRegister.gym_title"
                        />
                        <ValidationMessage
                            v-if="formRegister.errors?.gym_title"
                            :caption="formRegister.errors?.gym_title"
                        />
                    </InputGroup>

                    <InputGroup label="Domain" labelFor="domain-input">
                        <div class="flex gap-x-4">
                            <div class="flex-1">
                                <InputText
                                    inputId="domain-input"
                                    inputPlaceholder="typing domain"
                                    inputName="domain_input"
                                    v-model:input-value="formRegister.domain"
                                />
                            </div>
                            <div
                                class="place-content-center px-4 bg-primary-700 rounded-lg"
                            >
                                .localhost
                            </div>
                        </div>
                        <ValidationMessage
                            v-if="formRegister.errors?.domain"
                            :caption="formRegister.errors?.domain"
                        />
                    </InputGroup>
                </div>

                <InputGroup label="Address">
                    <InputTextArea
                        placeholder="Typing address"
                        v-model:input-value="formRegister.address"
                    />
                    <ValidationMessage
                        v-if="formRegister.errors?.address"
                        :caption="formRegister.errors?.address"
                    />
                </InputGroup>

                <InputGroup
                    label="Email"
                    labelFor="email-input"
                    note="Make sure your email is activated"
                >
                    <InputText
                        input-type="email"
                        input-placeholder="Typing email"
                        input-name="email_input"
                        v-model:input-value="formRegister.email"
                        input-id="email-input"
                    />
                    <ValidationMessage
                        v-if="formRegister.errors?.email"
                        :caption="formRegister.errors?.email"
                    />
                </InputGroup>

                <InputGroup label="Password" label-for="password-input">
                    <InputPassword
                        input-id="password-input"
                        v-model:input-value="formRegister.password"
                        :toggle-mask="true"
                    />
                    <ValidationMessage
                        v-if="formRegister.errors?.password"
                        :caption="formRegister.errors?.password"
                    />
                </InputGroup>

                <InputGroup
                    label="Confirm password"
                    label-for="confirm-password-input"
                >
                    <InputPassword
                        input-id="confirm-password-input"
                        v-model:input-value="formRegister.password_confirmation"
                        :toggle-mask="true"
                    />
                    <ValidationMessage
                        v-if="formRegister.errors?.password_confirmation"
                        :caption="formRegister.errors?.password_confirmation"
                    />
                </InputGroup>

                <div class="mt-12">
                    <PrimaryButton
                        class="w-full"
                        :label="submitBtnLabel"
                        type="submit"
                        :disabled="isFormSubmmited"
                    />
                </div>
            </form>
        </section>
    </div>
</template>
