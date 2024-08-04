<script setup>
import InputText from "@components/elements/input/InputText.vue";
import InputGroup from "@components/ui/group/InputGroup.vue";
import PrimaryButton from "@components/elements/button/PrimaryButton.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import MultiSelect from "primevue/multiselect";
import ValidationMessage from "@components/ui/cta/ValidationMessage.vue";
import { onMounted } from "vue";

const page = usePage();

const props = defineProps({
    mode: "create",
});

const requestForm = useForm({
    title: "",
    period_type: "",
    amount: "",
    status: null,
    features: null,
});

const periodTypeSelect = ["Monthly", "Half Yearly", "Yearly"];
const membershipPlanSubmit = () => {
    switch (props.mode) {
        case "edit":
            requestForm.put(
                route("tenant-dashboard.membership.update", {
                    membershipPlan: page.props.membershipPlanEditData.id,
                }),
                {
                    only: ["flash", "errors"],
                },
            );
        default:
            requestForm.post(route("tenant-dashboard.membership.create"), {
                only: ["flash", "errors"],
                onSuccess: () => {
                    requestForm.reset();
                },
            });
            break;
    }
};

onMounted(() => {
    if (props.mode === "edit") {
        const membershipDataEdit = page.props.membershipPlanEditData;
        requestForm.features = [];

        requestForm.title = membershipDataEdit.title;
        requestForm.period_type = membershipDataEdit.period_type;
        requestForm.amount = membershipDataEdit.amount;
        requestForm.status = membershipDataEdit.status;
        membershipDataEdit.membership_features.map((item) => {
            requestForm.features.push(item.id);
        });
    }
});
</script>

<template>
    <form autocomplete="off" @submit.prevent="membershipPlanSubmit">
        <InputGroup label="Membership Features">
            <MultiSelect
                v-model="requestForm.features"
                :options="page.props.getMembershipFeaturesActive"
                option-label="title"
                option-value="id"
                placeholder="Select membership features"
                max-selected-labels="3"
                filter
            />
            <ValidationMessage
                v-if="requestForm.errors.features"
                :caption="requestForm.errors.features"
            />
        </InputGroup>

        <InputGroup label="Title">
            <InputText
                input-type="text"
                input-placeholder="Typing title plan"
                input-name="title"
                v-model:inputValue="requestForm.title"
            />
            <ValidationMessage
                v-if="requestForm.errors.title"
                :caption="requestForm.errors.title"
            />
        </InputGroup>

        <InputGroup label="Period type">
            <select
                class="px-4 py-3 rounded-lg bg-primary-700"
                v-model="requestForm.period_type"
            >
                <option value="" selected disabled>
                    -- Select period type --
                </option>
                <option
                    v-for="(periodType, i) in periodTypeSelect"
                    :value="periodType"
                    :key="i"
                >
                    {{ periodType }}
                </option>
            </select>
            <ValidationMessage
                v-if="requestForm.errors.period_type"
                :caption="requestForm.errors.period_type"
            />
        </InputGroup>

        <InputGroup label="Amount">
            <InputText
                input-type="number"
                input-placeholder="Typing amount"
                input-name="amount"
                v-model:inputValue="requestForm.amount"
            />
            <ValidationMessage
                v-if="requestForm.errors.amount"
                :caption="requestForm.errors.amount"
            />
        </InputGroup>

        <InputGroup label="Status" v-if="mode === 'edit'">
            <select
                class="px-4 py-3 rounded-lg bg-primary-700"
                v-model="requestForm.status"
            >
                <option value="" selected disabled>-- Select status --</option>
                <option
                    value="ACTIVE"
                    :selected="requestForm.status === 'ACTIVE'"
                >
                    ACTIVE
                </option>
                <option
                    value="INACTIVE"
                    :selected="requestForm.status === 'INACTIVE'"
                >
                    INACTIVE
                </option>
            </select>
        </InputGroup>

        <PrimaryButton label="Submit" class="px-8" />
    </form>
</template>
