<script setup>
import PrimaryButton from "@components/elements/button/PrimaryButton.vue";
import InputText from "@components/elements/input/InputText.vue";
import ValidationMessage from "@components/ui/cta/ValidationMessage.vue";
import InputGroup from "@components/ui/group/InputGroup.vue";
import { router, useForm, usePage } from "@inertiajs/vue3";
import MultiSelect from "primevue/multiselect";
import { onMounted, toRef } from "vue";
import { route } from "ziggy-js";

const page = usePage();
const tenantPlanDetail = toRef(() => page.props.getTenantDetail);
const planFeatures = toRef(() => page.props.getPlanFeatures);
const tenantPlanVersionLists = toRef(() => page.props.getPlanVersions);

const form = useForm({
    title: "",
    price_per_month: "",
    price_per_year: "",
    version_id: "",
    features: [],
    version_status: "",
});

onMounted(() => {
    form.title = tenantPlanDetail.value.name;
    if (tenantPlanDetail.value.hasOwnProperty("tenant_version_latest")) {
        form.version = tenantPlanDetail.value.tenant_version_latest.version;
        form.version_id = tenantPlanDetail.value.tenant_version_latest.id;
        form.version_status =
            tenantPlanDetail.value.tenant_version_latest.status;
        form.price_per_month =
            tenantPlanDetail.value.tenant_version_latest.price_per_month;
        form.price_per_year =
            tenantPlanDetail.value.tenant_version_latest.price_per_year;
        tenantPlanDetail.value.tenant_version_latest.plan_features.map(
            (item) => {
                form.features.push(item.id);
            },
        );
    }

    if (tenantPlanDetail.value.hasOwnProperty("tenant_select_version")) {
        form.version = tenantPlanDetail.value.tenant_select_version.version;
        form.version_id = tenantPlanDetail.value.tenant_select_version.id;
        form.version_status =
            tenantPlanDetail.value.tenant_select_version.status;
        form.price_per_month =
            tenantPlanDetail.value.tenant_select_version.price_per_month;
        form.price_per_year =
            tenantPlanDetail.value.tenant_select_version.price_per_year;
        tenantPlanDetail.value.tenant_select_version.plan_features.map(
            (item) => {
                form.features.push(item.id);
            },
        );
    }
});

const selectVersionHandler = (id) => {
    router.visit(
        route("plan_tenant.table", {
            id: tenantPlanDetail.value.id,
            versionId: id,
        }),
        {
            method: "get",
            only: ["getTenantDetail"],
        },
    );
};

const formSubmitUpdateHandler = () => {
    form.put(
        route("plan_tenant.update", {
            planTenant: tenantPlanDetail.value.id,
        }),
        {
            only: ["errors", "flash"],
        },
    );
};
</script>

<template>
    <InputGroup label="Select version">
        <select
            name="tenant_version_select"
            id="tenant_version"
            class="px-4 py-3 rounded-lg bg-primary-700 border border-surface-500"
            v-model="form.version_id"
            @change="(e) => selectVersionHandler(e.target.value)"
        >
            <option value="" disabled selected>
                -- Select tenant version --
            </option>
            <option
                v-for="content in tenantPlanVersionLists"
                :key="content.id"
                :value="content.id"
            >
                {{ content.version }}
            </option>
        </select>
    </InputGroup>
    <form autocomplete="off" @submit.prevent="formSubmitUpdateHandler">
        <div class="inline-flex flex-col w-full mb-5 gap-y-3">
            <label for="title" class="block">Title</label>
            <InputText inputId="title" v-model:input-value="form.title" />
            <ValidationMessage
                v-if="form.errors.title"
                :caption="form.errors.title"
            />
        </div>
        <div
            class="inline-flex flex-col w-full mb-5 gap-y-3"
            v-if="form.features"
        >
            <label for="feature" class="block">Features</label>
            <MultiSelect
                v-model="form.features"
                :options="planFeatures"
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
        </div>

        <div class="grid lg:grid-cols-2 gap-x-8">
            <div class="inline-flex flex-col w-full mb-5 gap-y-3 md:mb-0">
                <label for="price_per_month" class="block"
                    >Price per month</label
                >
                <InputText
                    inputType="number"
                    inputId="price_per_month"
                    v-model:input-value="form.price_per_month"
                />
                <ValidationMessage
                    v-if="form.errors.price_per_month"
                    :caption="form.errors.price_per_month"
                />
            </div>
            <div class="inline-flex flex-col w-full gap-y-3 mb-6">
                <label for="price_per_year" class="block">Price per year</label>
                <InputText
                    inputType="number"
                    inputId="price_per_year"
                    v-model:input-value="form.price_per_year"
                />
                <ValidationMessage
                    v-if="form.errors.price_per_year"
                    :caption="form.errors.price_per_year"
                />
            </div>
        </div>
        <InputGroup label="Version Status">
            <select
                class="px-4 py-3 rounded-lg bg-primary-700"
                v-model="form.version_status"
            >
                <option value="" selected disabled>-- Select status --</option>
                <option
                    value="ACTIVE"
                    :selected="form.version_status === 'ACTIVE'"
                >
                    ACTIVE
                </option>
                <option
                    value="INACTIVE"
                    :selected="form.version_status === 'INACTIVE'"
                >
                    INACTIVE
                </option>
            </select>
        </InputGroup>

        <PrimaryButton type="submit" label="Submit" class="ml-auto" />
    </form>
</template>
