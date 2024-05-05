<script setup>
import { provide, ref, toRef, watch, watchEffect } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import SubscriptionsLayout from '@layouts/SubscriptionsLayout.vue';
import TablePagination from '@components/elements/pagination/TablePagination.vue';
import PrimaryButton from '@components/elements/button/PrimaryButton.vue';
import CreateForm from '@pages/dashboard/central_page/subscription_page/features_plan_page/CreateForm.vue';
import FeaturesContent from '@components/centralPages/dashboard/subscription/FeaturesContent.vue';
import { useToast } from 'primevue/usetoast';
import Toast from 'primevue/toast';

const openModal = ref(false);
const page = usePage();
const toast = useToast();
provide('visibleModal', openModal)

const props = defineProps({
    planFeaturesQuery: Object
})

const planFeaturesQuery = toRef(props, 'planFeaturesQuery')

function handlerPaginationFeature(page) {
    router.get(route('plan_feature.table'), {
        page: page
    }, {
        preserveScroll: true,
        preserveState: true
    })
}

watchEffect(() => {
    if (page.props.flash?.message_success) {
        toast.add({
            severity: "success",
            summary: "info",
            detail: page.props.flash?.message_success,
            life: 3000
        })
    }
})

// watch(() => page.props.flash?.message_success, (val) => {

// })


</script>

<template>
    <SubscriptionsLayout>
        <Toast />
        <CreateForm />

        <div class="p-6">
            <PrimaryButton icon="pi pi-plus" label="Add Feature" @click-event="() => openModal = true" />
        </div>

        <section class="pb-12">
            <FeaturesContent :featurePlanDatas="planFeaturesQuery" />
            <TablePagination v-if="!!planFeaturesQuery.data.length" :pagination="planFeaturesQuery"
                @load-page="handlerPaginationFeature" />
        </section>
    </SubscriptionsLayout>
</template>
