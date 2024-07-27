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
    <div class="grid lg:grid-cols-2">
        <DynamicSectionContent
            label="Name"
            :caption="subscriptionDataDetail?.tenant.name"
        />
        <DynamicSectionContent
            label="Domain"
            :caption="subscriptionDataDetail?.tenant.domains[0].domain"
        />
        <DynamicSectionContent
            label="Address"
            :caption="subscriptionDataDetail?.tenant.address"
        />
        <div>
            <h4 class="mb-3 text-base font-semibold capitalize">
                Tenant status
            </h4>
            <Badge
                :value="subscriptionDataDetail?.tenant.status"
                class="px-4 !text-white"
                :severity="[
                    subscriptionDataDetail?.tenant.status === 'ACTIVE'
                        ? 'success'
                        : 'danger',
                ]"
            />
        </div>
    </div>
</template>
