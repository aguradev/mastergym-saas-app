<script setup>
import ValidationMessage from "@components/ui/cta/ValidationMessage.vue";
import InputText from "@components/elements/input/InputText.vue";
import InputGroup from "@components/ui/group/InputGroup.vue";
import InputPassword from "@components/elements/input/InputPassword.vue";
import PrimaryButton from "@components/elements/button/PrimaryButton.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import PreviewImageFile from "../../../../../Lib/preview-img";
import { onMounted, ref, toRef } from "vue";
import { route } from "ziggy-js";

const previewImg = ref(null);
const page = usePage();

const props = defineProps({
    mode: {
        type: String,
        default: "create",
    },
});

const requestForm = useForm({
    profileImg: null,
    username: null,
    role: "",
    first_name: "",
    last_name: "",
    email: "",
    phone_number: null,
    password: "",
    password_confirmation: "",
});

const rolesLists = toRef(() => page.props.rolesLists);

const previewImageHandler = (e) => {
    previewImg.value = PreviewImageFile(e.target.files[0]);
};

onMounted(() => {
    if (props.mode === "edit") {
        const userData = page.props.getUserDetail;

        requestForm.username = userData.username;
        requestForm.role = userData.roles[0].name;
        requestForm.first_name = userData.first_name;
        requestForm.last_name = userData.last_name;
        requestForm.email = userData.email;
        requestForm.phone_number = userData.phone_number;

        previewImg.value = userData.profile_image;
    }
});

const userSubmitHandler = () => {
    switch (props.mode) {
        case "edit":
            requestForm.post(
                route("tenant-dashboard.user-management.update-user", {
                    user: page.props.getUserDetail?.id,
                }),
                {
                    _method: "put",
                    only: ["errors", "flash"],
                },
            );
            break;
        default:
            requestForm.post(
                route("tenant-dashboard.user-management.create-user"),
                {
                    only: ["modalUserCreate", "errors", "flash", "usersData"],
                    onSuccess: () => {
                        previewImg.value = null;
                        requestForm.reset();
                    },
                },
            );
            break;
    }
};
</script>

<template>
    <form action="#" @submit.prevent="userSubmitHandler" autocomplete="off">
        <InputGroup label="Upload Profile" class="gap-5 mb-4">
            <img
                v-if="previewImg != null"
                :src="previewImg"
                class="size-24 rounded-sm mb-4 object-cover"
            />
            <p>{{ previewImg }}</p>
            <input
                type="file"
                name="profile"
                @change="(e) => previewImageHandler(e)"
                @input="requestForm.profileImg = $event.target.files[0]"
            />
            <ValidationMessage
                v-if="requestForm.errors.profileImg"
                :caption="requestForm.errors.profileImg"
            />
        </InputGroup>
        <div class="grid lg:grid-cols-1 mb-5">
            <InputGroup label="Username" class="!mb-0">
                <InputText
                    input-type="text"
                    input-placeholder="Typing user name"
                    input-name="input_user_name"
                    v-model:inputValue="requestForm.username"
                />
                <ValidationMessage
                    v-if="requestForm.errors.username"
                    :caption="requestForm.errors.username"
                />
            </InputGroup>
        </div>
        <div class="mb-5">
            <InputGroup label="Select role" class="!mb-0">
                <select
                    class="px-4 py-3 rounded-lg bg-primary-700"
                    v-model="requestForm.role"
                >
                    <option value="" selected disabled>
                        -- Select roles --
                    </option>
                    <option
                        v-for="role in rolesLists"
                        :key="role.id"
                        :value="role.name"
                        :selected="requestForm.role === role.name"
                    >
                        {{ role.name }}
                    </option>
                </select>
                <ValidationMessage
                    v-if="requestForm.errors.role"
                    :caption="requestForm.errors.role"
                />
            </InputGroup>
        </div>
        <div class="grid lg:grid-cols-2 gap-4 mb-5">
            <InputGroup label="First Name" class="!mb-0">
                <InputText
                    input-type="text"
                    input-placeholder="Typing first name"
                    input-name="input_first_name"
                    v-model:inputValue="requestForm.first_name"
                />
                <ValidationMessage
                    v-if="requestForm.errors.first_name"
                    :caption="requestForm.errors.first_name"
                />
            </InputGroup>
            <InputGroup label="First Name" class="!mb-0">
                <InputText
                    input-type="text"
                    input-placeholder="Typing last name"
                    input-name="input_last_name"
                    v-model:inputValue="requestForm.last_name"
                />
                <ValidationMessage
                    v-if="requestForm.errors.last_name"
                    :caption="requestForm.errors.last_name"
                />
            </InputGroup>
        </div>
        <div class="grid grid-cols-1 gap-5 mb-5">
            <InputGroup label="Email" class="!mb-0">
                <InputText
                    input-type="email"
                    input-placeholder="Typing email"
                    input-name="user_email_input"
                    input-id="email-input"
                    v-model:inputValue="requestForm.email"
                />
                <ValidationMessage
                    v-if="requestForm.errors.email"
                    :caption="requestForm.errors.email"
                />
            </InputGroup>
            <InputGroup label="Phone number" class="!mb-0">
                <InputText
                    input-type="number"
                    input-placeholder="Typing phone number"
                    input-name="user_phone_number"
                    input-id="email-phone-number"
                    v-model:inputValue="requestForm.phone_number"
                />
                <ValidationMessage
                    v-if="requestForm.errors.phone_number"
                    :caption="requestForm.errors.phone_number"
                />
            </InputGroup>
        </div>
        <div class="grid lg:grid-cols-1 gap-5 mb-5">
            <InputGroup
                label="Password"
                label-for="password-input"
                class="!mb-0"
            >
                <InputPassword
                    input-id="password-input"
                    :toggle-mask="true"
                    v-model:inputValue="requestForm.password"
                />
                <ValidationMessage
                    v-if="requestForm.errors.password"
                    :caption="requestForm.errors.password"
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
                    v-model:inputValue="requestForm.password_confirmation"
                />
                <ValidationMessage
                    v-if="requestForm.errors.password_confirmation"
                    :caption="requestForm.errors.password_confirmation"
                />
            </InputGroup>
        </div>

        <PrimaryButton label="Submit" class="px-8" />
    </form>
</template>
