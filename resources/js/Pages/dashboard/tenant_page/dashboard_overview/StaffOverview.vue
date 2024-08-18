<script setup>
import { toRef } from "vue";
import { usePage } from "@inertiajs/vue3";

const page = usePage();
const totalStaff = toRef(() => page.props?.totalStaff);
const totalMembershipPlan = toRef(() => page.props?.totalMembershipPlan);
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
                <h2 class="font-semibold text-3xl">0</h2>
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
    </div>
</template>
