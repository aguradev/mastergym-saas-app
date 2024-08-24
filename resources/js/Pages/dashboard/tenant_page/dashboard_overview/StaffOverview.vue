<script setup>
import { onMounted, ref, toRef } from "vue";
import { usePage } from "@inertiajs/vue3";
import Chart from "primevue/chart";

const page = usePage();
const totalStaff = toRef(() => page.props?.totalStaff);
const totalTrainee = toRef(() => page.props?.totalTrainee);
const totalMembershipPlan = toRef(() => page.props?.totalMembershipPlan);
const membershipDatasets = toRef(() => page.props?.membershipDatasets);

const chartData = ref(() => {});
const chartOptions = ref(() => {});
const incomeData = ref(() =>
    membershipDatasets.value.map((item) => item.total_income),
);
const dateDatasets = ref(() =>
    membershipDatasets.value.map((item) => item.months),
);

onMounted(() => {
    chartOptions.value = () => {
        return {
            plugins: {
                legend: {
                    labels: {
                        color: "#FFF",
                    },
                },
            },
            scales: {
                x: {
                    ticks: {
                        color: "#FFF",
                    },
                    grid: {
                        color: "rgb(01 183 65)",
                    },
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: "rgb(01 183 65)",
                    },
                    grid: {
                        color: "transparent",
                    },
                },
            },
        };
    };
    chartData.value = () => {
        const mainColor = "rgb(01 183 65)";
        const subColor = "rgb(47 82 34)";
        return {
            labels: dateDatasets.value(),
            datasets: [
                {
                    label: "Total Income",
                    data: incomeData.value(),
                    borderColor: mainColor,
                    fill: true,
                    tension: 0.4,
                    backgroundColor: subColor,
                },
            ],
        };
    };
});
</script>

<template>
    <div class="grid grid-cols-3 gap-6 mb-8">
        <figure class="bg-primary-800 border border-surface-500 p-5 rounded-lg">
            <figcaption>
                <h4 class="font-semibold text-xl mb-4">Total Staff</h4>
                <h2 class="font-semibold text-3xl">{{ totalStaff }}</h2>
            </figcaption>
        </figure>
        <figure class="bg-primary-800 border border-surface-500 p-5 rounded-lg">
            <figcaption>
                <h4 class="font-semibold text-xl mb-4">Total Trainees</h4>
                <h2 class="font-semibold text-3xl">{{ totalTrainee }}</h2>
            </figcaption>
        </figure>
        <figure class="bg-primary-800 border border-surface-500 p-5 rounded-lg">
            <figcaption>
                <h4 class="font-semibold text-xl mb-4">Membership plan</h4>
                <h2 class="font-semibold text-3xl">
                    {{ totalMembershipPlan }}
                </h2>
            </figcaption>
        </figure>
    </div>
    <div class="bg-primary-800 border border-surface-500 p-5 rounded-lg">
        <h4 class="font-semibold text-xl mb-4">Income</h4>
        <Chart
            type="bar"
            :data="chartData()"
            :options="chartOptions()"
            :height="100"
        />
    </div>
</template>
