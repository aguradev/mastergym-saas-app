<script setup>
import DynamicSectionContent from "@components/ui/dynamicDetailContent/Index.vue";
import axiosHttp from "@lib/axios";
import { route } from "ziggy-js";
import { onMounted, ref } from "vue";
import FormatCurrency from "@lib/Currency";
import PrimaryButton from "@components/elements/button/PrimaryButton.vue";

const props = defineProps({
    id: String,
    versionPlanId: String,
});

const planDetails = ref(null);
const tenantVersionsLists = ref(null);

const emits = defineEmits(["newVersionEvent", "selectVersionEvent"]);

const fetchDetailPlan = async () => {
    try {
        const res = await axiosHttp(
            route("plan_tenant.json.detail", {
                planTenant: props.id,
                planVersionId: props?.versionPlanId,
            }),
        );

        if (res.status == 200) {
            planDetails.value = await res.data;
        }
    } catch (err) {
        console.log(err);
    }
};

const fetchTenantPlanVersions = async () => {
    try {
        const res = await axiosHttp(
            route("plan_tenant.json.versions", {
                planTenant: props.id,
            }),
        );

        if (res.status == 200) {
            tenantVersionsLists.value = await res.data.tenant_log_versions;
        }
    } catch (err) {
        console.log(err);
    }
};

await fetchDetailPlan();
await fetchTenantPlanVersions();

const selecteVersionHandler = (value) => {
    emits("selectVersionEvent", value);
};
</script>

<template>
    <section id="plan_detail">
        <select
            name="tenant_version_select"
            id="tenant_version"
            class="px-4 py-3 rounded-lg bg-primary-700 border border-surface-500"
            v-model="planDetails.tenant_version_latest.id"
            @change="(e) => selecteVersionHandler(e.target.value)"
        >
            <option value="" disabled selected>
                -- Select tenant version --
            </option>
            <option
                v-for="content in tenantVersionsLists"
                :key="content.id"
                :value="content.id"
            >
                {{ content.version }}
            </option>
        </select>
        <div class="grid my-8">
            <DynamicSectionContent label="title" :caption="planDetails.name" />
            <div class="flex items-center gap-x-14">
                <DynamicSectionContent
                    label="Price per month"
                    :caption="
                        FormatCurrency(
                            planDetails.tenant_version_latest.price_per_month,
                        )
                    "
                />
                <DynamicSectionContent
                    label="Price per yearly"
                    :caption="
                        FormatCurrency(
                            planDetails.tenant_version_latest.price_per_year,
                        )
                    "
                />
            </div>
            <DynamicSectionContent
                label="Latest version"
                :caption="`v.${planDetails.tenant_version_latest.version}`"
            />
            <div class="mb-8">
                <h4 class="mb-4 text-base font-semibold capitalize">
                    Features
                </h4>
                <ul
                    class="flex flex-col gap-x-14 gap-y-4 justify-between max-w-[400px]"
                >
                    <li
                        v-for="(feature, i) in planDetails.tenant_version_latest
                            .plan_features"
                        :key="feature.id"
                        class="text-base"
                    >
                        {{ feature.name }}
                    </li>
                </ul>
            </div>
            <PrimaryButton
                label="Add new version"
                @click-event="$emit('newVersionEvent')"
            />
        </div>
    </section>
</template>
