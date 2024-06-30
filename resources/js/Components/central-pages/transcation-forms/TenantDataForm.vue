<script setup>
import { useTenantRegistration } from "@stores/tenant_registration_state";
import { storeToRefs } from "pinia";
import InputText from "@components/elements/input/InputText.vue";
import InputGroup from "@components/ui/group/InputGroup.vue";
import InputTextArea from "@components/elements/input/InputTextArea.vue";
import ValidationMessage from "@components/ui/cta/ValidationMessage.vue";
const useTenantRegisterState = useTenantRegistration();
const { formRegister } = storeToRefs(useTenantRegisterState);
</script>

<template>
    <div class="grid lg:grid-cols-2 gap-5">
        <InputGroup label="Gym title" labelFor="gym-title-input">
            <InputText
                inputId="gym-title-input"
                inputPlaceholder="Typing title"
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
                        inputPlaceholder="Typing domain"
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

    <InputGroup
        label="Email"
        labelFor="email-input"
        note="Make sure your email is activated"
    >
        <InputText
            input-type="email"
            input-placeholder="Typing email"
            input-name="gym_email_input"
            v-model:input-value="formRegister.gym_email"
            input-id="email-input"
        />
        <ValidationMessage
            v-if="formRegister.errors?.gym_email"
            :caption="formRegister.errors?.gym_email"
        />
    </InputGroup>

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
</template>
