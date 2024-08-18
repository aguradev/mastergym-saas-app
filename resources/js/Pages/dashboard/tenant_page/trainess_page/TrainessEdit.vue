<script setup>
import PrimaryButton from "@components/elements/button/PrimaryButton.vue";
import InputGroup from "@components/ui/group/InputGroup.vue";
import { router, useForm, usePage } from "@inertiajs/vue3";
import { route } from "ziggy-js";
import { computed, onMounted } from "vue";
import ValidationMessage from "@components/ui/cta/ValidationMessage.vue";

const transactionStatusLists = ["CANCEL", "PAID", "PENDING", "NEED CONFIRM"];
const membershipStatus = ["ACTIVE", "INACTIVE"];
const page = usePage();
const memberTrainess = computed(() => page.props.memberTrainessDetail);

const requestForm = useForm({
    transaction_status: "",
    membership_status: "",
});

onMounted(() => {
    requestForm.transaction_status = memberTrainess.value.transaction_status;
    requestForm.membership_status = memberTrainess.value.membership_status;
});

const trainessSubmitHandler = () => {
    requestForm.put(
        route("tenant-dashboard.trainess.update", {
            memberTrainee: memberTrainess.value.id,
        }),
        {
            only: ["errors", "flash"],
        },
    );
};
</script>

<template>
    <form autocomplete="off" @submit.prevent="trainessSubmitHandler">
        <InputGroup
            label="Transaction status"
            v-if="memberTrainess.transaction_status != 'PAID'"
        >
            <select
                class="px-4 py-3 rounded-lg bg-primary-700"
                v-model="requestForm.transaction_status"
            >
                <option value="" selected disabled>
                    -- Select transaction status --
                </option>
                <option
                    v-for="(status, i) in transactionStatusLists"
                    :value="status"
                    :key="i"
                >
                    {{ status }}
                </option>
            </select>
            <ValidationMessage
                v-if="requestForm.errors.transaction_status"
                :caption="requestForm.errors.transaction_status"
            />
        </InputGroup>
        <InputGroup label="Membership status">
            <select
                class="px-4 py-3 rounded-lg bg-primary-700"
                v-model="requestForm.membership_status"
            >
                <option value="" selected disabled>
                    -- Select membership status --
                </option>
                <option
                    v-for="(status, i) in membershipStatus"
                    :value="status"
                    :key="i"
                >
                    {{ status }}
                </option>
            </select>
            <ValidationMessage
                v-if="requestForm.errors.membership_status"
                :caption="requestForm.errors.membership_status"
            />
        </InputGroup>
        <PrimaryButton type="submit" class="ml-auto" label="submit" />
    </form>
</template>
