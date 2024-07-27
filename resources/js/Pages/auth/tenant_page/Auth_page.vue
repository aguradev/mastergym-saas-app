<script setup>
import { Head, useForm, usePage } from "@inertiajs/vue3";
import InputElement from "@components/elements/input/InputText.vue";
import InputPassword from "@components/elements/input/InputPassword.vue";
import PrimaryButton from "@components/elements/button/PrimaryButton.vue";

const page = usePage();
const { tenantName } = page.props;

const formAuth = useForm({
    user_email: null,
    password: null,
});
</script>

<template>
    <Head>
        <title>Login</title>
    </Head>

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

            <form action="#" method="post">
                <div class="flex flex-col gap-2 mb-8">
                    <label for="user_email">Email</label>
                    <InputElement
                        v-model:inputValue="formAuth.user_email"
                        input-type="text"
                        input-id="user_email"
                        input-placeholder="example@mastergym.com"
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
