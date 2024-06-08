<script setup>
import DynamicSectionContent from "@components/ui/dynamicDetailContent/Index.vue"
import axiosHttp from "@lib/axios";
import { route } from "ziggy-js";
import { onMounted, ref } from "vue";
import FormatCurrency from "@lib/Currency";
import PrimaryButton from "@components/elements/button/PrimaryButton.vue";

const props = defineProps({
    id: String
})

const features = [
    "Booking personal trainer",
    "Manage personal trainer",
    "Manage staff",
    "30 staff account",
    "100 staff account",
    "Unlimited staff account",
    "50 membership user",
    "100 membership user",
    "500 membership user",
    "Unlimited membership user",
];

const planDetails = ref(null)

const fetchDetailPlan = async () => {
    try {
        const res = await axiosHttp(route('plan_tenant.json.detail', {
            planTenant: props.id
        }))

        if (res.status == 200) {
            planDetails.value = await res.data;
        }


    } catch (err) {
        console.log(err)
    }
}

await fetchDetailPlan();
</script>

<template>
    <div class="grid my-8">
        <DynamicSectionContent label="title" :caption="planDetails.name" />
        <div class="flex items-center gap-x-14">
            <DynamicSectionContent label="Price per month" :caption="FormatCurrency(planDetails.price_per_month)" />
            <DynamicSectionContent label="Price per yearly" :caption="FormatCurrency(planDetails.price_per_year)" />
        </div>
        <DynamicSectionContent label="Latest version" :caption="`v.${planDetails.plan_version}`" />
        <div class="mb-8">
            <h4 class="mb-4 text-base font-semibold capitalize">Features</h4>
            <ul class="flex flex-col gap-x-14 gap-y-4 justify-between max-w-[400px]">
                <li v-for="(feature, i) in planDetails.plan_features" :key="feature.id" class="text-base">{{
                    feature.name }}</li>
            </ul>
        </div>
        <PrimaryButton label="Add new version" />
    </div>
</template>
