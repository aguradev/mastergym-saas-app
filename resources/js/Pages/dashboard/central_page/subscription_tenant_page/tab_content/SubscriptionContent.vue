<script setup>
import DynamicSectionContent from "@components/ui/dynamicDetailContent/Index.vue";
import { usePage } from "@inertiajs/vue3";
import Badge from "primevue/badge";
import { toRef } from "vue";

const page = usePage();

const subscriptionDataDetail = toRef(
    () => page.props.getSubscriptionDataDetail,
);
</script>

<template>
    <section>
        <div class="grid lg:grid-cols-3">
            <DynamicSectionContent
                label="Owner name"
                :caption="subscriptionDataDetail?.transaction.full_name"
            />
            <DynamicSectionContent
                label="Plan Purchase"
                :caption="
                    subscriptionDataDetail?.transaction.plan_purchase
                        .tenant_subscription_plan.name
                "
            />
            <DynamicSectionContent
                label="Period type"
                :caption="subscriptionDataDetail?.transaction.period_type"
            />
            <DynamicSectionContent
                label="Date start"
                :caption="subscriptionDataDetail?.date_and_time_start_date"
            />
            <DynamicSectionContent
                label="Due Date"
                :caption="subscriptionDataDetail?.date_and_time_due_date"
            />
            <div>
                <h4 class="mb-3 text-base font-semibold capitalize">Status</h4>
                <Badge
                    :value="subscriptionDataDetail?.status"
                    class="px-4 !text-white"
                    :severity="[
                        subscriptionDataDetail.status === 'ACTIVE'
                            ? 'success'
                            : 'danger',
                    ]"
                />
            </div>
            <div>
                <h4 :class="`mb-3 text-base font-semibold capitalize`">
                    Plan Feature
                </h4>
                <ul>
                    <li
                        v-for="feature in subscriptionDataDetail?.transaction
                            .plan_purchase.plan_features"
                        class="mb-3"
                    >
                        {{ feature.name }}
                    </li>
                </ul>
            </div>
        </div>
    </section>
</template>
