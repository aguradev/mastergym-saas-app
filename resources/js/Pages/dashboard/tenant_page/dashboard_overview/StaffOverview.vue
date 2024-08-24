<script setup>
import { onMounted, ref, toRef } from "vue";
import { usePage } from "@inertiajs/vue3";
import Chart from "primevue/chart";

const page = usePage();
const totalStaff = toRef(() => page.props?.totalStaff);
const totalTrainee = toRef(() => page.props?.totalTrainee);
const totalMembershipPlan = toRef(() => page.props?.totalMembershipPlan);

const chartData = ref(() => {});
const chartOptions = ref(() => {});

onMounted(() => {
    chartOptions.value = () => {
        const documentStyle = getComputedStyle(document.documentElement);

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
        return {
            labels: ["Q1", "Q2", "Q3", "Q4"],
            datasets: [
                {
                    label: "Sales",
                    data: [540, 325, 702, 620],
                    backgroundColor: [
                        "rgba(249, 115, 22, 0.2)",
                        "rgba(6, 182, 212, 0.2)",
                        "rgb(107, 114, 128, 0.2)",
                        "rgba(139, 92, 246 0.2)",
                    ],
                    borderColor: [
                        "rgb(249, 115, 22)",
                        "rgb(6, 182, 212)",
                        "rgb(107, 114, 128)",
                        "rgb(139, 92, 246)",
                    ],
                    borderWidth: 1,
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
