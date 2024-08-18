<script setup>
import { ref } from "vue";
import axiosHttp from "@lib/axios";
import PrimaryButton from "@components/elements/button/PrimaryButton.vue";
import InputGroup from "@components/ui/group/InputGroup.vue";
import MultiSelect from "primevue/multiselect";
import InputText from "@components/elements/input/InputText.vue";

const props = defineProps({
    id: String,
});

const planDetails = ref(null);
const features = ref(null);
const emits = defineEmits(["newVersionEvent"]);

async function fetchingFeatures() {
    try {
        const res = await axiosHttp.get(route("plan_feature.json.all"));

        if (res.status == 200) {
            features.value = res.data;
        }
    } catch (err) {
        console.log(err);
    }
}

const fetchDetailPlan = async () => {
    try {
        const res = await axiosHttp(
            route("plan_tenant.json.detail", {
                planTenant: props.id,
            }),
        );

        if (res.status == 200) {
            planDetails.value = await res.data;
        }
    } catch (err) {
        console.log(err);
    }
};

await fetchDetailPlan();
await fetchingFeatures();
</script>

<template>
    <section>
        <form action="#" autocomplete="off">
            <InputGroup label="Title">
                <span class="font-semibold text-lg">{{
                    planDetails.name
                }}</span>
            </InputGroup>
            <InputGroup label="Features">
                <MultiSelect
                    :options="features.results"
                    optionLabel="name"
                    placeholder="Select Features"
                    max-selected-labels="4"
                    filter
                />
            </InputGroup>
            <InputGroup label="Price per month">
                <InputText inputType="number" inputId="price_per_month" />
            </InputGroup>
            <InputGroup label="Price per year">
                <InputText inputType="number" inputId="price_per_year" />
            </InputGroup>
            <InputGroup label="Version">
                <InputText inputType="text" inputId="version" />
            </InputGroup>
            <div>
                <PrimaryButton label="Add new version" />
            </div>
        </form>
    </section>
</template>
