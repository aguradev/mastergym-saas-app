<script setup>
import InputText from "@components/elements/input/InputText.vue";
import InputTextArea from "@components/elements/input/InputTextArea.vue";
import InputGroup from "@components/ui/group/InputGroup.vue";
</script>

<template>
    <div class="grid lg:grid-cols-2 gap-4">
        <InputGroup label="Full name" labelFor="full_name">
            <InputText
                input-type="text"
                input-placeholder="Type full name"
                input-name="full_name"
                input-id="full_name"
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
            />
        </InputGroup>
    </div>
    <div class="mb-4">
        <InputGroup label="Address">
            <InputTextArea placeholder="Type address" />
        </InputGroup>
    </div>
</template>
