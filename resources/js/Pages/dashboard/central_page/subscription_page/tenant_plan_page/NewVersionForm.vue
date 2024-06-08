<script setup>
import { ref } from "vue";
import axiosHttp from "@lib/axios";
import PrimaryButton from "@components/elements/button/PrimaryButton.vue";

const props = defineProps({
    id: String,
});

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

const planDetails = ref(null);
const emits = defineEmits(["newVersionEvent"]);

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
console.log(planDetails.value);
</script>

<template>
    <section>
        <form action="#" autocomplete="off">
            <div class="inline-flex flex-col w-full mb-5 gap-y-3">
                <label for="title" class="block">Select version</label>
                <select class="px-4 py-3 rounded-lg bg-primary-700">
                    <option value="#">-- Select version --</option>
                    <option :value="planDetails.id">
                        v.{{ planDetails.plan_version }}
                    </option>
                </select>
            </div>
            <div>
                <PrimaryButton label="Load" />
            </div>
        </form>
    </section>
</template>
