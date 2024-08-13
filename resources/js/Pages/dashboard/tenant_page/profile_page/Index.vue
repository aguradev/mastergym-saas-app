<script setup>
import DashboardTenantLayout from "@layouts/DashboardTenantLayout.vue";
import InputGroup from "@components/ui/group/InputGroup.vue";
import InputText from "@components/elements/input/InputText.vue";
import ValidationMessage from "@components/ui/cta/ValidationMessage.vue";

import { useForm, usePage } from "@inertiajs/vue3";
import { computed, onMounted, ref } from "vue";
import PrimaryButton from "@components/elements/button/PrimaryButton.vue";
import PreviewImageFile from "../../../../Lib/preview-img";

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
});

const page = usePage();
const userProfile = computed(() => page.props.userLogin);

onMounted(() => {
    formRequest.username = userProfile.value.username;
    formRequest.email = userProfile.value.email;
    formRequest.first_name = userProfile.value.user.first_name;
    formRequest.last_name = userProfile.value.user.last_name;
    formRequest.phone_number = userProfile.value.user.phone_number;

    previewImg.value = userProfile.value.user.profile_image;
});
</script>

<template>
    <DashboardTenantLayout>
        <div class="px-6 py-4">
            <form autocomplete="off">
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
                        @input="formRequest.profile = $event.target.files[0]"
                    />
                </div>

                <div class="grid lg:grid-cols-2 gap-4 max-w-[1200px]">
                    <InputGroup label="Username" labelFor="username">
                        <InputText
                            input-type="text"
                            input-placeholder="Type username"
                            input-name="username"
                            input-id="username"
                            v-model:inputValue="formRequest.username"
                        />
                        <ValidationMessage />
                    </InputGroup>
                    <InputGroup label="Email" labelFor="email">
                        <InputText
                            input-type="text"
                            input-placeholder="Type email"
                            input-name="email"
                            input-id="email"
                            v-model:inputValue="formRequest.email"
                        />
                        <ValidationMessage />
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
                        <ValidationMessage />
                    </InputGroup>
                    <InputGroup label="Last name" labelFor="Last name">
                        <InputText
                            input-type="text"
                            input-placeholder="Type last name"
                            input-name="last_name"
                            input-id="last_name"
                            v-model:inputValue="formRequest.last_name"
                        />
                        <ValidationMessage />
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
                        <ValidationMessage />
                    </InputGroup>
                </div>

                <PrimaryButton label="Update Profile" type="submit" />
            </form>
        </div>
    </DashboardTenantLayout>
</template>
