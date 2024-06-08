<script setup>
import { ref } from "vue";
import axiosHttp from "@lib/axios";
import InputText from "@components/elements/input/InputText.vue";

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
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
        </form>
    </section>
</template>
