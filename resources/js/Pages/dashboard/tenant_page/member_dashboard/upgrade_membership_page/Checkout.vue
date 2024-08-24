<script setup>
import InputGroup from "@components/ui/group/InputGroup.vue";
import { usePage } from "@inertiajs/vue3";
import DynamicDetailContent from "@components/ui/dynamicDetailContent/Index.vue";
import { onMounted, toRef, ref } from "vue";
import FormatCurrency from "../../../../../Lib/Currency";
import { useMembershipRegisterStore } from "@stores/tenant_membership_register_store";
import Modal from "@components/ui/modal/Index.vue";

import { storeToRefs } from "pinia";
import PrimaryButton from "@components/elements/button/PrimaryButton.vue";
import ValidationMessage from "@components/ui/cta/ValidationMessage.vue";
const page = usePage();

const membershipRegistrationStores = useMembershipRegisterStore();
const modalCaution = ref(false);

const { formRequestRegistration } = storeToRefs(membershipRegistrationStores);
const emits = defineEmits(["nextStepEvent"]);

const membershipCheckout = toRef(() => page.props.getMembershipDataSelected);
const vaNumber = page.props.tenantVaNumber;

const modalCautionHandler = () => {
    window.scrollTo(0, 0);
    modalCaution.value = true;
};

const subscriptionMembershipSubmitHandler = () => {
    formRequestRegistration.value.post(
        route("membership.processing-checkout"),
        {
            replace: true,
            only: ["errors"],
            preserveState: true,
            onFinish: () => {
                modalCaution.value = false;
            },
            onSuccess: () => {
                formRequestRegistration.value.reset();
                emits("nextStepEvent");
            },
        },
    );
};
</script>

<template>
    <div class="mb-8">
        <section class="px-8 py-6 rounded-xl border border-surface-500 mb-8">
            <h2 class="text-2xl mb-8 font-semibold">Plan Checkout</h2>
            <div v-if="membershipCheckout !== undefined">
                <div class="grid grid-cols-5">
                    <DynamicDetailContent
                        label="title"
                        :caption="membershipCheckout?.title"
                        classLabel="text-xl"
                        classCaption="!text-xl"
                    />
                    <DynamicDetailContent
                        label="Period type"
                        :caption="membershipCheckout?.period_type"
                        classLabel="text-xl"
                        classCaption="!text-xl"
                    />
                    <DynamicDetailContent
                        label="amount"
                        :caption="FormatCurrency(membershipCheckout?.amount)"
                        classLabel="text-xl"
                        classCaption="!text-xl"
                    />
                </div>
                <div class="mb-8">
                    <h4 class="text-xl mb-6 font-semibold capitalize`">
                        Features
                    </h4>
                    <ul class="flex flex-col gap-y-4">
                        <li
                            v-for="feature in membershipCheckout?.membership_features"
                            :key="feature.id"
                        >
                            <i class="pi pi-check text-white mr-3"></i>
                            <span>{{ feature.title }}</span>
                        </li>
                    </ul>
                </div>
                <div class="flex items-center gap-x-16">
                    <DynamicDetailContent
                        label="tax"
                        :caption="membershipCheckout?.tax"
                        classLabel="text-xl"
                        classCaption="!text-xl"
                    />
                    <DynamicDetailContent
                        label="Total amount"
                        :caption="FormatCurrency(membershipCheckout?.total)"
                        classLabel="text-xl"
                        classCaption="!text-xl"
                    />
                </div>
            </div>
        </section>

        <section>
            <h2 class="text-2xl mb-8 font-semibold">Payment</h2>
            <DynamicDetailContent
                label="Virtual account number"
                :caption="vaNumber"
                classLabel="text-xl"
                classCaption="!text-xl"
            />
        </section>
        <hr class="border-primary-500 my-8" />

        <form autocomplete="off" @submit.prevent="modalCautionHandler">
            <InputGroup label="Upload invoice transfer payment">
                <input
                    type="file"
                    name="invoice_upload"
                    class="mt-3"
                    @input="
                        formRequestRegistration.imageInvoiceUpload =
                            $event.target.files[0]
                    "
                />
                <ValidationMessage
                    v-if="formRequestRegistration.errors.imageInvoiceUpload"
                    :caption="formRequestRegistration.errors.imageInvoiceUpload"
                />
            </InputGroup>
            <InputGroup label="Fitness Goal">
                <textarea
                    name="fitness_goal"
                    class="bg-primary-900 outline-none rounded-lg border border-surface-500 p-4 h-[300px] mt-2 resize-none"
                    placeholder="Type your fitness goal"
                    v-model="formRequestRegistration.fitnessGoal"
                ></textarea>
                <ValidationMessage
                    v-if="formRequestRegistration.errors.fitnessGoal"
                    :caption="formRequestRegistration.errors.fitnessGoal"
                />
            </InputGroup>

            <PrimaryButton label="Submit" type="submit" class="ml-auto !px-8" />
        </form>

        <Modal :modalVisible="modalCaution">
            <div class="text-center">
                <p class="leading-8">
                    Please double-check your payment invoice before submitting
                    the checkout form. <br />
                    Ensure that the correct invoice is uploaded to avoid any
                    delays or issues with your order processing.
                </p>
                <div class="flex items-center justify-center mt-8 gap-4">
                    <PrimaryButton
                        label="Cancel"
                        type="button"
                        class="bg-transparent hover:bg-transparent"
                        @clickEvent="() => (modalCaution = false)"
                    />
                    <PrimaryButton
                        label="Yes, my data is correct"
                        type="button"
                        @clickEvent="subscriptionMembershipSubmitHandler"
                    />
                </div>
            </div>
        </Modal>
    </div>
</template>
