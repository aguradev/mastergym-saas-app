<script setup>
    import InputText from '@components/elements/input/InputText.vue';
    import InputPassword from '@components/elements/input/InputPassword.vue';
    import InputGroup from '@components/ui/group/InputGroup.vue';
    import PrimaryButton from '@components/elements/button/PrimaryButton.vue';
    import ValidationMessage from '@components/ui/cta/ValidationMessage.vue';
</script>

<template>
    <div class="h-screen grid justify-content-center justify-items-center place-content-center">
        <div class="min-w-[600px]">
            <form
                action="#"
                autocomplete="off"
            >
                <div class="p-8 text-center rounded-md">
                    <p class="text-4xl font-medium">Registration</p>
                </div>
                <div class="">
                    <InputGroup
                        label="Username"
                        label-for=""
                        class="!mb-4"
                    >
                        <InputText
                            inputId=""
                            input-placeholder="Username..."
                        />
                        <ValidationMessage />
                    </InputGroup>
                </div>
                <div class="">
                    <InputGroup
                        label="Email"
                        label-for=""
                        class="!mb-4"
                    >
                        <InputText
                            inputId=""
                            input-placeholder="Email..."
                        />
                        <ValidationMessage />
                    </InputGroup>
                </div>
                <div class="">
                    <InputGroup
                        label="Password"
                        label-for=""
                        class="!mb-4"
                    >
                        <InputPassword
                            inputId=""
                            :toggle-mask="true"
                            input-placeholder="Password..."
                        />
                        <ValidationMessage />
                    </InputGroup>
                </div>
                <div class="">
                    <InputGroup
                        label="Confirm Password"
                        label-for=""
                        class="!mb-4"
                    >
                        <InputPassword
                            inputId=""
                            :toggle-mask="true"
                            input-placeholder="Confirm Password..."
                        />
                        <ValidationMessage />
                    </InputGroup>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="">
                        <InputGroup
                            label="First Name"
                            label-for=""
                            class="!mb-4"
                        >
                            <InputText
                                inputId=""
                                input-placeholder="First name..."
                            />
                            <ValidationMessage />
                        </InputGroup>
                    </div>
                    <div class="">
                        <InputGroup
                            label="Last Name"
                            label-for=""
                            class="!mb-4"
                        >
                            <InputText
                                inputId=""
                                input-placeholder="Last Name..."
                            />
                            <ValidationMessage />
                        </InputGroup>
                    </div>
                </div>
                <div class="">
                    <InputGroup
                        label="Phone Number"
                        label-for=""
                        class="!mb-4"
                    >
                        <InputText
                            inputId=""
                            inputType="number"
                            input-placeholder="Phone Number..."
                        />
                        <ValidationMessage />
                    </InputGroup>
                </div>
                <div class="flex justify-end">
                    <PrimaryButton
                        label="Register"
                        class="!px-5 !font-normal"
                    />
                </div>
            </form>
        </div>
    </div>
</template>
