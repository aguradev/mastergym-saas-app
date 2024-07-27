<script setup>
import InputText from "@components/elements/input/InputText.vue";
import InputTextArea from "@components/elements/input/InputTextArea.vue";
import ValidationMessage from "@components/ui/cta/ValidationMessage.vue";
import InputGroup from "@components/ui/group/InputGroup.vue";
import { useCentralCheckout } from "@stores/central_checkout_state";
import { storeToRefs } from "pinia";
import { watch } from "vue";

const useCentralCheckoutState = useCentralCheckout();
const { checkoutOrderRequest, checkoutOrderMessageValidation } = storeToRefs(
    useCentralCheckoutState,
);

watch(
    () => checkoutOrderMessageValidation.value,
    (newValue) => {
        if (newValue !== null) {
            console.log(newValue);
        }
    },
);
</script>

<template>
    <div class="grid lg:grid-cols-2 gap-4">
        <InputGroup label="Full name" labelFor="full_name">
            <InputText
                input-type="text"
                input-placeholder="Type full name"
                input-name="full_name"
                input-id="full_name"
                v-model:inputValue="checkoutOrderRequest.full_name"
            />
            <ValidationMessage
                v-if="checkoutOrderMessageValidation?.full_name"
                :caption="checkoutOrderMessageValidation?.full_name[0]"
            />
        </InputGroup>
        <InputGroup
            label="Email"
            labelFor="email"
            note="Make sure your email is activated"
        >
            <InputText
                input-type="email"
                input-placeholder="Type email"
                input-name="email"
                input-id="email"
                v-model:inputValue="checkoutOrderRequest.email"
            />
            <ValidationMessage
                v-if="checkoutOrderMessageValidation?.email"
                :caption="checkoutOrderMessageValidation?.email[0]"
            />
        </InputGroup>
    </div>
    <div class="mb-4">
        <InputGroup label="Phone number">
            <InputText
                input-type="number"
                input-placeholder="Type phone number"
                input-name="phone_number"
                input-id="phone_number"
                v-model:inputValue="checkoutOrderRequest.phone_number"
            />
            <ValidationMessage
                v-if="checkoutOrderMessageValidation?.phone_number"
                :caption="checkoutOrderMessageValidation?.phone_number[0]"
            />
        </InputGroup>
    </div>
    <div class="mb-4">
        <InputGroup label="Address">
            <InputTextArea
                placeholder="Type address"
                v-model:inputValue="checkoutOrderRequest.address"
            />
            <ValidationMessage
                v-if="checkoutOrderMessageValidation?.address"
                :caption="checkoutOrderMessageValidation?.address[0]"
            />
        </InputGroup>
    </div>
</template>
