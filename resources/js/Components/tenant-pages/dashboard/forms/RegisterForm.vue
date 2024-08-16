<script setup>
import InputText from "@components/elements/input/InputText.vue";
import InputPassword from "@components/elements/input/InputPassword.vue";
import InputGroup from "@components/ui/group/InputGroup.vue";
import PrimaryButton from "@components/elements/button/PrimaryButton.vue";
import ValidationMessage from "@components/ui/cta/ValidationMessage.vue";
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const formRequest = useForm({
    username: "",
    email: "",
    first_name: "",
    last_name: "",
    phone_number: "",
    password: "",
    password_confirmation: "",
});

const submitLabel = ref("Submit");
const isDisabled = ref(false);

const formRequestSubmit = () => {
    formRequest.post(route("tenant.registration.submit"), {
        onStart: () => {
            submitLabel.value = "Loading...";
            isDisabled.value = true;
        },
        onFinish: () => {
            submitLabel.value = "Submit";
            isDisabled.value = false;
        },
    });
};
</script>

<template>
    <div
        class="h-screen grid justify-content-center justify-items-center place-content-center"
    >
        <div class="min-w-[600px]">
            <form autocomplete="off" @submit.prevent="formRequestSubmit">
                <div class="p-8 text-center rounded-md">
                    <p class="text-4xl font-medium">Registration</p>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <InputGroup label="First name" labelFor="First name">
                        <InputText
                            input-type="text"
                            input-placeholder="Type first name"
                            input-name="first_name"
                            input-id="first_name"
                            v-model:inputValue="formRequest.first_name"
                        />
                        <ValidationMessage
                            v-if="formRequest.errors.first_name"
                            :caption="formRequest.errors.first_name"
                        />
                    </InputGroup>
                    <InputGroup label="Last name" labelFor="Last name">
                        <InputText
                            input-type="text"
                            input-placeholder="Type last name"
                            input-name="last_name"
                            input-id="last_name"
                            v-model:inputValue="formRequest.last_name"
                        />
                        <ValidationMessage
                            v-if="formRequest.errors.last_name"
                            :caption="formRequest.errors.last_name"
                        />
                    </InputGroup>
                </div>
                <InputGroup label="Phone number" labelFor="Phone number">
                    <InputText
                        input-type="number"
                        input-placeholder="Type phone number"
                        input-name="phone_number"
                        input-id="phone_number"
                        v-model:inputValue="formRequest.phone_number"
                    />
                    <ValidationMessage
                        v-if="formRequest.errors.phone_number"
                        :caption="formRequest.errors.phone_number"
                    />
                </InputGroup>
                <InputGroup label="Username" labelFor="username">
                    <InputText
                        input-type="text"
                        input-placeholder="Type username"
                        input-name="username"
                        input-id="username"
                        v-model:inputValue="formRequest.username"
                    />
                    <ValidationMessage
                        v-if="formRequest.errors.username"
                        :caption="formRequest.errors.username"
                    />
                </InputGroup>
                <div class="">
                    <InputGroup label="Email" labelFor="email">
                        <InputText
                            input-type="text"
                            input-placeholder="Type email"
                            input-name="email"
                            input-id="email"
                            v-model:inputValue="formRequest.email"
                        />
                        <ValidationMessage
                            v-if="formRequest.errors.email"
                            :caption="formRequest.errors.email"
                        />
                    </InputGroup>
                </div>
                <InputGroup
                    label="Password"
                    label-for="password-input"
                    class="!mb-4"
                >
                    <InputPassword
                        input-id="password-input"
                        :toggle-mask="true"
                        v-model:inputValue="formRequest.password"
                    />
                    <ValidationMessage
                        v-if="formRequest.errors.password"
                        :caption="formRequest.errors.password"
                    />
                </InputGroup>
                <InputGroup
                    label="Confirm password"
                    label-for="confirm-password-input"
                    class="!mb-4"
                >
                    <InputPassword
                        input-id="confirm-password-input"
                        :toggle-mask="true"
                        v-model:inputValue="formRequest.password_confirmation"
                    />
                    <ValidationMessage
                        v-if="formRequest.errors.password_confirmation"
                        :caption="formRequest.errors.password_confirmation"
                    />
                </InputGroup>
                <div class="flex justify-end mt-8">
                    <PrimaryButton
                        :label="submitLabel"
                        class="!px-5 !font-normal w-full"
                        :disabled="isDisabled"
                    />
                </div>
            </form>
        </div>
    </div>
</template>
