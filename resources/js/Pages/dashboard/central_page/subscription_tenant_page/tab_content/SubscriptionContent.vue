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
    <div class="grid">
        <DynamicSectionContent
            label="Owner name"
            :caption="subscriptionDataDetail?.transaction.full_name"
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
    </div>
</template>
