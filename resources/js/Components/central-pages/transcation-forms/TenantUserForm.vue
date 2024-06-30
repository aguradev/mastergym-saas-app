<script setup>
import ValidationMessage from "@components/ui/cta/ValidationMessage.vue";
import InputText from "@components/elements/input/InputText.vue";
import InputGroup from "@components/ui/group/InputGroup.vue";
import { useTenantRegistration } from "@stores/tenant_registration_state";
import { storeToRefs } from "pinia";
import InputPassword from "@components/elements/input/InputPassword.vue";

const tenantRegistrationState = useTenantRegistration();
const { formRegister } = storeToRefs(tenantRegistrationState);
</script>

<template>
    <div class="grid grid-cols-2 gap-x-4">
        <InputGroup label="First Name">
            <InputText
                input-type="text"
                input-placeholder="Typing first name"
                input-name="input_first_name"
                v-model:input-value="formRegister.first_name"
            />
            <ValidationMessage
                v-if="formRegister.errors?.first_name"
                :caption="formRegister.errors?.first_name"
            />
        </InputGroup>
        <InputGroup label="Last Name">
            <InputText
                input-type="text"
                input-placeholder="Typing last name"
                input-name="input_last_name"
                v-model:input-value="formRegister.last_name"
            />
            <ValidationMessage
                v-if="formRegister.errors?.last_name"
                :caption="formRegister.errors?.last_name"
            />
        </InputGroup>
    </div>

    <InputGroup
        label="Email"
        labelFor="email-input"
        note="Make sure your email is activated"
    >
        <InputText
            input-type="email"
            input-placeholder="Typing email"
            input-name="user_email_input"
            v-model:input-value="formRegister.user_email"
            input-id="email-input"
        />
        <ValidationMessage
            v-if="formRegister.errors?.user_email"
            :caption="formRegister.errors?.user_email"
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

    <InputGroup label="Confirm password" label-for="confirm-password-input">
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
</template>
