<script setup>
import DashboardTenantLayout from "@layouts/DashboardTenantLayout.vue";
import InputGroup from "@components/ui/group/InputGroup.vue";
import InputText from "@components/elements/input/InputText.vue";
import ValidationMessage from "@components/ui/cta/ValidationMessage.vue";

import { useForm, usePage } from "@inertiajs/vue3";
import { route } from "ziggy-js";
import { computed, onMounted, ref, watchEffect } from "vue";
import PrimaryButton from "@components/elements/button/PrimaryButton.vue";
import PreviewImageFile from "../../../../Lib/preview-img";
import InputPassword from "@components/elements/input/InputPassword.vue";
import { useToast } from "primevue/usetoast";
import Toast from "primevue/toast";

const toast = useToast();
const previewImg = ref(null);

const previewImageHandler = (e) => {
    previewImg.value = PreviewImageFile(e.target.files[0]);
};

const formRequest = useForm({
    profile: "",
    username: "",
    email: "",
    first_name: "",
    last_name: "",
    phone_number: "",
    password: "",
    password_confirmation: "",
});

const page = usePage();
const userProfile = computed(() => page.props.userLogin);

const submitUpdateHandler = (e) => {
    formRequest.post(
        route("tenant-dashboard.profile.update", {
            user: userProfile.value?.id,
        }),
        {
            _method: "put",
            only: ["errors", "flash"],
        },
    );
};

onMounted(() => {
    formRequest.username = userProfile.value.username;
    formRequest.email = userProfile.value.email;
    formRequest.first_name = userProfile.value.first_name;
    formRequest.last_name = userProfile.value.last_name;
    formRequest.phone_number = userProfile.value.phone_number;

    previewImg.value = userProfile.value.profile_image;
});

watchEffect(() => {
    if (page.props.flash?.message_error) {
        toast.add({
            severity: "error",
            summary: "info",
            detail: page.props.flash?.message_error,
            life: 3000,
        });
    }

    if (page.props.flash?.message_success) {
        toast.add({
            severity: "success",
            summary: "info",
            detail: page.props.flash?.message_success,
            life: 3000,
        });
    }
});
</script>

<template>
    <DashboardTenantLayout>
        <Toast />
        <div class="px-6 py-4">
            <form autocomplete="off" @submit.prevent="submitUpdateHandler">
                <InputGroup>
                    <div class="mb-8 flex items-end gap-x-4">
                        <div class="size-48 rounded-full overflow-hidden">
                            <img
                                :src="previewImg"
                                class="overflow-hidden w-full h-full object-cover"
                            />
                        </div>
                        <input
                            type="file"
                            name="profile"
                            @change="(e) => previewImageHandler(e)"
                            @input="
                                formRequest.profile = $event.target.files[0]
                            "
                        />
                    </div>
                    <ValidationMessage
                        v-if="formRequest.errors.profile"
                        :caption="formRequest.errors.profile"
                    />
                </InputGroup>

                <div class="grid lg:grid-cols-2 gap-4 max-w-[1200px]">
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
                <div class="grid lg:grid-cols-2 gap-4 max-w-[1200px]">
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
                <div class="max-w-[1200px]">
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
                </div>
                <div class="grid lg:grid-cols-1 gap-5 mb-5 max-w-[1200px]">
                    <InputGroup
                        label="Password"
                        label-for="password-input"
                        class="!mb-0"
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
                        class="!mb-0"
                    >
                        <InputPassword
                            input-id="confirm-password-input"
                            :toggle-mask="true"
                            v-model:inputValue="
                                formRequest.password_confirmation
                            "
                        />
                        <ValidationMessage
                            v-if="formRequest.errors.password_confirmation"
                            :caption="formRequest.errors.password_confirmation"
                        />
                    </InputGroup>
                </div>

                <PrimaryButton label="Update Profile" type="submit" />
            </form>
        </div>
    </DashboardTenantLayout>
</template>
