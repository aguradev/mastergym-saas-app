<script setup>
import DashboardTenantLayout from "@layouts/DashboardTenantLayout.vue";
import { usePage } from "@inertiajs/vue3";
import StaffOverview from "./dashboard_overview/StaffOverview.vue";
import MemberOverview from "./dashboard_overview/MemberOverview.vue";
import { toRef } from "vue";

const page = usePage();
const staffRole = toRef(() => page.props.staffRoleAssign);
const memberAssign = toRef(() => page.props.memberRoleAssign);
</script>

<template>
    <DashboardTenantLayout>
        <section class="px-8 py-6">
            <StaffOverview v-if="staffRole" />
            <MemberOverview v-if="memberAssign" />
        </section>
    </DashboardTenantLayout>
</template>
