<script setup>
import ValidationMessage from "@components/ui/cta/ValidationMessage.vue";
import InputText from "@components/elements/input/InputText.vue";
import InputGroup from "@components/ui/group/InputGroup.vue";
import PrimaryButton from "@components/elements/button/PrimaryButton.vue";
import { useForm } from "@inertiajs/vue3";

const requestForm = useForm({
    title: "",
});
</script>

<template>
    <form autocomplete="off">
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
