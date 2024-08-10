<script setup>
import InputText from "@components/elements/input/InputText.vue";
import InputGroup from "@components/ui/group/InputGroup.vue";
import InputTextArea from "@components/elements/input/InputTextArea.vue";
import ValidationMessage from "@components/ui/cta/ValidationMessage.vue";
import { useForm } from "@inertiajs/vue3";
import PrimaryButton from "@components/elements/button/PrimaryButton.vue";
import { onMounted } from "vue";
import { route } from "ziggy-js";

const tenantRequest = useForm({
    gym_title: "",
    domain: "",
    address: "",
    gym_email: "",
    va_number: "",
});

const props = defineProps({
    tenantData: Object,
});

onMounted(() => {
    const tenantDataMounted = props.tenantData;

    tenantRequest.gym_title = tenantDataMounted.name;
    tenantRequest.domain = tenantDataMounted.domains[0].domain;
    tenantRequest.gym_email = tenantDataMounted.email;
    tenantRequest.address = tenantDataMounted.address;
    tenantRequest.va_number = tenantDataMounted.virtual_account_number;
});

const tenantHandlerSubmit = (e) => {
    tenantRequest.put(
        route("tenant-configuration.update", {
            tenant: props.tenantData?.id,
        }),
        {
            only: ["flash", "errors"],
        },
    );
};
</script>

<template>
    <form autocomplete="off" @submit.prevent="tenantHandlerSubmit">
        <div class="grid lg:grid-cols-2 gap-5">
            <InputGroup label="Gym title" labelFor="gym-title-input">
                <InputText
                    inputId="gym-title-input"
                    inputPlaceholder="Typing title"
                    inputName="gym_title_input"
                    v-model:inputValue="tenantRequest.gym_title"
                />
                <ValidationMessage
                    v-if="tenantRequest.errors?.gym_title"
                    :caption="tenantRequest.errors?.gym_title"
                />
            </InputGroup>

            <InputGroup label="Domain" labelFor="domain-input">
                <div class="flex gap-x-4">
                    <div class="flex-1">
                        <InputText
                            inputId="domain-input"
                            inputPlaceholder="Typing domain"
                            inputName="domain_input"
                            v-model:input-value="tenantRequest.domain"
                            :is-readonly="true"
                        />
                    </div>
                </div>
                <ValidationMessage
                    v-if="tenantRequest.errors?.domain"
                    :caption="tenantRequest.errors?.domain"
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
                v-model:input-value="tenantRequest.gym_email"
                input-id="email-input"
            />
            <ValidationMessage
                v-if="tenantRequest.errors?.gym_email"
                :caption="tenantRequest.errors?.gym_email"
            />
        </InputGroup>

        <InputGroup label="Address">
            <InputTextArea
                placeholder="Typing address"
                v-model:input-value="tenantRequest.address"
            />
            <ValidationMessage
                v-if="tenantRequest.errors?.address"
                :caption="tenantRequest.errors?.address"
            />
        </InputGroup>

        <InputGroup label="VA number" labelFor="va_number">
            <InputText
                input-type="text"
                input-placeholder="Typing VA number"
                input-name="va_account_number"
                v-model:input-value="tenantRequest.va_number"
                input-id="va_number"
            />
            <ValidationMessage
                v-if="tenantRequest.errors?.va_number"
                :caption="tenantRequest.errors?.va_number"
            />
        </InputGroup>

        <PrimaryButton type="submit" label="Submit" />
    </form>
</template>
