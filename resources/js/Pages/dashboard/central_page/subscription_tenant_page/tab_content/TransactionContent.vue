<script setup>
import DynamicSectionContent from "@components/ui/dynamicDetailContent/Index.vue";
import { usePage } from "@inertiajs/vue3";
import Badge from "primevue/badge";
import { toRef } from "vue";
import FormatCurrency from "../../../../../Lib/Currency";
import PrimaryButton from "@components/elements/button/PrimaryButton.vue";

const page = usePage();

const subscriptionDataDetail = toRef(
    () => page.props.getSubscriptionDataDetail,
);
</script>

<template>
    <div class="grid lg:grid-cols-2 mb-8 gap-4">
        <DynamicSectionContent
            label="Full name"
            :caption="subscriptionDataDetail.transaction.full_name"
            class="!mb-0"
        />
        <DynamicSectionContent
            label="Email"
            :caption="subscriptionDataDetail.transaction.email"
            class="!mb-0"
        />
    </div>
    <div class="grid lg:grid-cols-2 mb-8">
        <DynamicSectionContent
            label="Payment Type"
            :caption="subscriptionDataDetail.transaction.payment_type"
            class="!mb-0"
        />

        <div>
            <h4 class="mb-3 text-base font-semibold capitalize">Status</h4>
            <Badge
                :value="subscriptionDataDetail.transaction.status"
                class="px-4 !text-white"
                :severity="[
                    subscriptionDataDetail.transaction.status === 'PENDING'
                        ? 'info'
                        : subscriptionDataDetail.transaction.status === 'PAID'
                          ? 'success'
                          : 'danger',
                ]"
            />
        </div>
    </div>
    <div class="mb-8">
        <DynamicSectionContent
            label="Payment Gateway Url"
            :caption="subscriptionDataDetail.transaction.payment_gateway_url"
            class="!mb-0"
        />
    </div>
    <div class="grid lg:grid-cols-2 mb-8">
        <DynamicSectionContent
            label="Tax"
            :caption="FormatCurrency(subscriptionDataDetail.transaction.tax)"
            class="!mb-0"
        />
        <DynamicSectionContent
            label="Total + Tax"
            :caption="FormatCurrency(subscriptionDataDetail.transaction.total)"
            class="!mb-0"
        />
    </div>
    <div class="grid lg:grid-cols-2 mb-8">
        <DynamicSectionContent
            label="Transaction expired countdown"
            :caption="
                subscriptionDataDetail.transaction.expired_countdown ?? '-'
            "
            class="!mb-0"
        />
        <DynamicSectionContent
            label="Transaction expired date"
            :caption="
                subscriptionDataDetail.transaction.transaction_expired_at
                    ? new Date(
                          subscriptionDataDetail.transaction.transaction_expired_at,
                      ).toDateString()
                    : '-'
            "
            class="!mb-0"
        />
    </div>
    <div>
        <PrimaryButton label="Download Invoice" />
    </div>
</template>
