<script setup>
import { ref } from "vue";
import axiosHttp from "@lib/axios";
import PrimaryButton from "@components/elements/button/PrimaryButton.vue";
import InputGroup from "@components/ui/group/InputGroup.vue";
import MultiSelect from "primevue/multiselect";
import InputText from "@components/elements/input/InputText.vue";
import { router, useForm } from "@inertiajs/vue3";
import { route } from "ziggy-js";
import ValidationMessage from "@components/ui/cta/ValidationMessage.vue";

const props = defineProps({
    id: String,
});

const planDetails = ref(null);
const features = ref(null);
const emits = defineEmits(["newVersionEvent"]);

const form = useForm({
    price_per_month: "",
    price_per_year: "",
    features: null,
    version: "",
});
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

const formNewVersionSubmit = () => {
    form.post(
        route("plan_tenant.create-new-version", {
            planTenant: props.id,
        }),
        {
            preserveState: true,
            only: ["errors", "flash"],
            method: "POST",
            onSuccess: () => {
                form.reset();
            },
        },
    );
};
</script>

<template>
    <section>
        <form autocomplete="off" @submit.prevent="formNewVersionSubmit">
            <InputGroup label="Title">
                <span class="font-semibold text-lg">{{
                    planDetails.name
                }}</span>
            </InputGroup>
            <InputGroup label="Features">
                <MultiSelect
                    v-model="form.features"
                    :options="features.results"
                    optionLabel="name"
                    option-value="id"
                    placeholder="Select Features"
                    max-selected-labels="4"
                    filter
                />
                <ValidationMessage
                    v-if="form.errors.features"
                    :caption="form.errors.features"
                />
            </InputGroup>
            <InputGroup label="Price per month">
                <InputText
                    inputType="number"
                    inputId="price_per_month"
                    v-model:input-value="form.price_per_month"
                />
                <ValidationMessage
                    v-if="form.errors.price_per_month"
                    :caption="form.errors.price_per_month"
                />
            </InputGroup>
            <InputGroup label="Price per year">
                <InputText
                    inputType="number"
                    inputId="price_per_year"
                    v-model:input-value="form.price_per_year"
                />
                <ValidationMessage
                    v-if="form.errors.price_per_year"
                    :caption="form.errors.price_per_year"
                />
            </InputGroup>
            <InputGroup label="Version">
                <InputText
                    inputType="text"
                    inputId="version"
                    v-model:input-value="form.version"
                />
                <ValidationMessage
                    v-if="form.errors.version"
                    :caption="form.errors.version"
                />
            </InputGroup>
            <div>
                <PrimaryButton type="submit" label="Add new version" />
            </div>
        </form>
    </section>
</template>
