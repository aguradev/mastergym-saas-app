<script setup>
import InputText from "@components/elements/input/InputText.vue";
import InputGroup from "@components/ui/group/InputGroup.vue";
import PrimaryButton from "@components/elements/button/PrimaryButton.vue";
import InputPassword from "@components/elements/input/InputPassword.vue";
import InputTextArea from "@components/elements/input/InputTextArea.vue";
</script>

<template>
    <div class="grid place-content-center items-center h-screen">
        <section
            class="bg-primary-800 border border-surface-700 rounded-lg py-8 px-6 min-w-[600px]"
        >
            <h3 class="font-bold text-2xl text-center mb-4">
                Tenant registration
            </h3>

            <form action="#" autocomplete="off">
                <InputGroup label="Gym title" labelFor="gym-input">
                    <InputText
                        inputId="gym-title-input"
                        inputPlaceholder="typing title"
                        inputName="gym_title_input"
                    />
                </InputGroup>

                <InputGroup label="Address">
                    <InputTextArea placeholder="Typing address" />
                </InputGroup>

                <InputGroup label="Domain" labelFor="domain-input">
                    <div class="flex gap-x-4">
                        <div class="flex-1">
                            <InputText
                                inputId="domain-input"
                                inputPlaceholder="typing domain"
                                inputName="domain_input"
                            />
                        </div>
                        <div
                            class="place-content-center px-4 bg-primary-700 rounded-lg"
                        >
                            .localhost
                        </div>
                    </div>
                </InputGroup>

                <InputGroup label="Email" labelFor="email">
                    <InputText
                        input-type="email"
                        input-placeholder="Typing email"
                    />
                </InputGroup>

                <InputGroup label="Password" label-for="password-input">
                    <InputPassword input-id="password-input" />
                </InputGroup>

                <InputGroup
                    label="Confirm password"
                    label-for="confirm-password-input"
                >
                    <InputPassword input-id="confirm-password-input" />
                </InputGroup>

                <PrimaryButton label="Register" class="w-full" type="submit" />
            </form>
        </section>
    </div>
</template>
