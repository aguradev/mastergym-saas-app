<script setup>
import ValidationMessage from "@components/ui/cta/ValidationMessage.vue";
import InputText from "@components/elements/input/InputText.vue";
import InputGroup from "@components/ui/group/InputGroup.vue";
import PrimaryButton from "@components/elements/button/PrimaryButton.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { route } from "ziggy-js";
import { onMounted } from "vue";

const page = usePage();

const requestForm = useForm({
    title: "",
    status: "",
});

const props = defineProps({
    mode: {
        type: String,
        default: "create",
    },
});

const membershipFeatureSubmitHandler = () => {
    switch (props.mode) {
        case "create":
            requestForm.post(
                route("tenant-dashboard.membership.create-feature"),
                {
                    only: ["errors", "flash", "membershipFeatures"],
                    onSuccess: () => {
                        requestForm.reset();
                    },
                },
            );
            break;
        case "edit":
            requestForm.put(
                route("tenant-dashboard.membership.update-feature", {
                    membershipFeature: page.props.getMembershipDetail.id,
                }),
                {
                    only: ["errors", "flash", "membershipFeatures"],
                },
            );
            break;
        default:
            break;
    }
};

onMounted(() => {
    if (props.mode === "edit") {
        const membershipEditData = page.props.getMembershipDetail;
        requestForm.title = membershipEditData.title;
        requestForm.status = membershipEditData.status;
    }
});
</script>

<template>
    <form autocomplete="off" @submit.prevent="membershipFeatureSubmitHandler">
        <InputGroup label="Title">
            <InputText
                input-type="text"
                input-placeholder="Typing title membership feature"
                input-name="input_user_name"
                v-model:inputValue="requestForm.title"
            />
            <ValidationMessage
                v-if="requestForm.errors.title"
                :caption="requestForm.errors.title"
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
