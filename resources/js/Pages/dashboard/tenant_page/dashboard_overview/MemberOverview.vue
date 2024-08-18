<script setup>
import { usePage } from "@inertiajs/vue3";
import RegistrationSubscription from "@pages/dashboard/tenant_page/member_dashboard/overview/registration_subscription/Index.vue";
import { computed } from "vue";
const page = usePage();

const traineeActive = computed(() => page.props.findTraineeActive);
</script>

<template>
    <section>
        <RegistrationSubscription v-if="!traineeActive" />
    </section>
</template>
