<script setup>
import ValidationMessage from "@components/ui/cta/ValidationMessage.vue";
import InputText from "@components/elements/input/InputText.vue";
import InputGroup from "@components/ui/group/InputGroup.vue";
import PrimaryButton from "@components/elements/button/PrimaryButton.vue";
import { useForm } from "@inertiajs/vue3";
import { route } from "ziggy-js";

const requestForm = useForm({
    title: "",
});

const roleSubmitHandler = () => {
    requestForm.post(route("tenant-dashboard.user-management.create-role"), {
        only: ["rolesDatas", "modalCreate", "errors", "flash"],
        onSuccess: () => {
            requestForm.reset();
        },
    });
};
</script>

<template>
    <form autocomplete="off" @submit.prevent="roleSubmitHandler">
        <InputGroup label="Role">
            <InputText
                input-type="text"
                input-placeholder="Typing role"
                input-name="input_user_name"
                v-model:inputValue="requestForm.title"
            />
            <ValidationMessage
                v-if="requestForm.errors.title"
                :caption="requestForm.errors.title"
            />
        </InputGroup>

        <PrimaryButton label="Submit" class="px-8" />
    </form>
</template>
