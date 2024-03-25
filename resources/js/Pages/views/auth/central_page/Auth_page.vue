<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import { reactive, ref } from 'vue';
import InputElement from '@/elements/input/DefaultInput.vue';
import Button from 'primevue/button';
import Toast from 'primevue/toast';
import { useToast } from 'primevue/usetoast';

const toast = useToast();
const buttonSubmit = ref(null);

const formAuth = useForm({
    username: null,
    password: null,
})

const errorMessages = reactive({
    errorCredential: null,
    validationMessage: {}
})

const submitLogin = () => {
    formAuth.post('/dashboard/login', {
        onSuccess: () => {
            formAuth.reset();
        },
        onError: () => {
            formAuth.reset();
            let { errorCredential, validationMessage } = errorMessages
            errorCredential = formAuth.errors?.message
            Object.assign(validationMessage, {
                username: formAuth.errors?.username,
                password: formAuth.errors.password
            })

            if (errorCredential) {
                toast.add({
                    severity: "error",
                    summary: "Info",
                    detail: errorCredential,
                    life: 5000
                })
            }
        }
    })
}
</script>

<style scoped>
.auth_section {
    @apply max-w-sm mx-auto h-screen flex flex-col justify-center;

    h3 {
        @apply mb-5
    }
}
</style>


<template>

    <Head>
        <title>Login page</title>
    </Head>

    <Toast />

    <section class="auth_section">

        <h2 class="mb-12 text-4xl font-bold text-center">Gym Master Admin</h2>

        <form @submit.prevent="submitLogin" autocomplete="off">
            <div class="flex flex-col gap-6">
                <div class="flex flex-col gap-2">
                    <label for="usernameEmailInput">Email</label>
                    <InputElement v-model:inputValue="formAuth.username" inputType="text" inputId="usernameEmailInput"
                        inputPlaceholder="example@gmail.com" />
                    <span class="text-danger-300" v-if="errorMessages.validationMessage.username">
                        {{ errorMessages.validationMessage.username }}
                    </span>
                </div>
                <div class="flex flex-col gap-2">
                    <label for="passwordInput">Password</label>
                    <InputElement v-model:inputValue="formAuth.password" inputType="password" inputId="password"
                        inputPlaceholder="password" />
                    <span class="text-danger-300" v-if="errorMessages.validationMessage.password">
                        {{ errorMessages.validationMessage.password }}
                    </span>
                </div>
            </div>

            <div class="flex items-center mt-12">
                <Button
                    :pt="{ root: 'flex justify-center gap-x-2 items-center bg-surface-600 px-4 text-base py-4 rounded-xl text-white hover:bg-surface-700 w-full' }"
                    type="submit" :disabled="formAuth.processing" :loading="loadingButton" label="Sign in"
                    ref="buttonSubmit" />
            </div>
        </form>
    </section>
</template>
