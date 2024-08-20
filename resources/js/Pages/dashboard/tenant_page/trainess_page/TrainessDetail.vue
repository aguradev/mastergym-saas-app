<script setup>
import { usePage } from "@inertiajs/vue3";
import DynamicDetailContent from "@components/ui/dynamicDetailContent/Index.vue";
import Badge from "primevue/badge";
import { toRef } from "vue";
import FormatCurrency from "../../../../Lib/Currency";

const page = usePage();
const memberTrainessDetail = toRef(() => page.props.memberTrainessDetail);
</script>

<template>
    <section class="grid grid-cols-3 gap-x-4 gap-y-8 my-8">
        <DynamicDetailContent
            label="Invoice id"
            :caption="`#${memberTrainessDetail.invoice_id}`"
            class="!mb-0"
            classLabel="!text-xl"
            classCaption="!text-lg"
        />
        <DynamicDetailContent
            label="Fullname"
            :caption="memberTrainessDetail.user.full_name"
            class="!mb-0"
            classLabel="!text-xl"
            classCaption="!text-lg"
        />
        <DynamicDetailContent
            label="Email"
            :caption="memberTrainessDetail.user.tenant_credential.email"
            class="!mb-0"
            classLabel="!text-xl"
            classCaption="!text-lg"
        />
        <DynamicDetailContent
            label="Phone number"
            :caption="memberTrainessDetail.user.phone_number"
            class="!mb-0"
            classLabel="!text-xl"
            classCaption="!text-lg"
        />
        <DynamicDetailContent
            label="Membership plan"
            :caption="memberTrainessDetail.membership_plan.title"
            class="!mb-0"
            classLabel="!text-xl"
            classCaption="!text-lg"
        />
        <DynamicDetailContent
            label="Period type"
            :caption="memberTrainessDetail.membership_plan.period_type"
            class="!mb-0"
            classLabel="!text-xl"
            classCaption="!text-lg"
        />
        <DynamicDetailContent
            label="Membership amount"
            :caption="
                FormatCurrency(memberTrainessDetail.membership_plan.amount)
            "
            class="!mb-0"
            classLabel="!text-xl"
            classCaption="!text-lg"
        />
        <DynamicDetailContent
            label="Transaction date"
            :caption="memberTrainessDetail.created_at_date_format"
            class="!mb-0"
            classLabel="!text-xl"
            classCaption="!text-lg"
        />
        <DynamicDetailContent
            label="Membership start date"
            :caption="memberTrainessDetail.start_date_format"
            class="!mb-0"
            classLabel="!text-xl"
            classCaption="!text-lg"
        />
        <DynamicDetailContent
            label="Membership expired date"
            :caption="memberTrainessDetail.expired_date_format"
            class="!mb-0"
            classLabel="!text-xl"
            classCaption="!text-lg"
        />
        <DynamicDetailContent
            label="Tax"
            :caption="FormatCurrency(memberTrainessDetail.tax)"
            class="!mb-0"
            classLabel="!text-xl"
            classCaption="!text-lg"
        />
        <DynamicDetailContent
            label="Total"
            :caption="FormatCurrency(memberTrainessDetail.total)"
            class="!mb-0"
            classLabel="!text-xl"
            classCaption="!text-lg"
        />
        <div class="mb-0">
            <h4 :class="`mb-3 text-xl font-semibold capitalize`">
                Transaction status
            </h4>
            <Badge
                :severity="`${memberTrainessDetail.transaction_status === 'PENDING' ? 'info' : memberTrainessDetail.transaction_status === 'PAID' ? 'success' : 'info'}`"
                :value="memberTrainessDetail.transaction_status"
                class="w-[40%]"
            />
        </div>
        <div class="mb-0">
            <h4 :class="`mb-3 text-xl font-semibold capitalize`">
                Membership status
            </h4>
            <Badge
                :severity="`${memberTrainessDetail.membership_status === 'INACTIVE' ? 'danger' : memberTrainessDetail.membership_status === 'ACTIVE' ? 'success' : 'info'}`"
                :value="memberTrainessDetail.membership_status"
                class="w-[40%]"
            />
        </div>
        <div class="mb-0">
            <h4 :class="`mb-3 text-xl font-semibold capitalize`">
                Photo invoice url
            </h4>
            <a
                :href="memberTrainessDetail.invoice_photo_url"
                target="_blank"
                class="underline"
            >
                Open image in new tab
            </a>
        </div>
    </section>
    <section>
        <DynamicDetailContent
            label="Fitness goal"
            :caption="`${memberTrainessDetail.fitness_goal}`"
            class="!mb-0"
            classLabel="!text-xl"
            classCaption="!text-lg"
        />
    </section>
</template>
