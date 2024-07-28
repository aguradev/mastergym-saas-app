<script setup>
import { Head, useForm, usePage } from "@inertiajs/vue3";
import InputElement from "@components/elements/input/InputText.vue";
import InputPassword from "@components/elements/input/InputPassword.vue";
import PrimaryButton from "@components/elements/button/PrimaryButton.vue";
import { route } from "ziggy-js";
import Toast from "primevue/toast";
import { useToast } from "primevue/usetoast";
import { watchEffect } from "vue";
import ValidationMessage from "@components/ui/cta/ValidationMessage.vue";

const page = usePage();
const toast = useToast();
const { tenantName } = page.props;

const formAuth = useForm({
    email: null,
    password: null,
});

const submitLogin = () => {
    formAuth.post(route("tenant.authenticable-dashboard"));
};

watchEffect(() => {
    if (page.props.flash?.message_error) {
        toast.add({
            severity: "error",
            summary: "info",
            detail: page.props.flash?.message_error,
            life: 3000,
        });
    }
});
</script>

<template>
    <Head>
        <title>{{ tenantName }} - Login</title>
    </Head>

    <Toast />

    <div class="grid lg:grid-cols-2 h-screen">
        <div class="relative">
            <img
                src="https://images.unsplash.com/photo-1517838277536-f5f99be501cd?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                class="w-full h-full object-cover"
                alt="image"
            />
        </div>
        <div class="min-w-[600px] mx-auto place-content-center">
            <h2 class="mb-12 text-4xl font-bold text-center">
                Welcome to {{ tenantName }}
            </h2>

            <form
                action="#"
                method="post"
                @submit.prevent="submitLogin"
                autocomplete="off"
            >
                <div class="flex flex-col gap-2 mb-8">
                    <label for="user_email">Email</label>
                    <InputElement
                        v-model:inputValue="formAuth.email"
                        input-type="text"
                        input-id="user_email"
                        input-placeholder="example@mastergym.com"
                    />
                    <ValidationMessage
                        v-if="formAuth.errors.email"
                        :caption="formAuth.errors.email"
                    />
                </div>
                <div class="flex flex-col gap-2">
                    <label for="password">Password</label>
                    <InputPassword
                        v-model:inputValue="formAuth.password"
                        inputId="password"
                        inputPlaceholder="password"
                        :toggleMask="true"
                    />
                    <ValidationMessage
                        v-if="formAuth.errors.password"
                        :caption="formAuth.errors.password"
                    />
                </div>

                <PrimaryButton
                    type="submit"
                    label="Sign in"
                    class="w-full mt-12"
                />
            </form>
        </div>
    </div>
</template>
