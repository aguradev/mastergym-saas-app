<script setup>
import { provide, ref, toRef, watch } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import SubscriptionsLayout from '@/components/layouts/SubscriptionsLayout.vue';
import TablePagination from '@/components/elements/pagination/TablePagination.vue';
import PrimaryButton from '@/components/elements/button/PrimaryButton.vue';
import CreateForm from '@/views/dashboard/central_page/subscription_page/featuresPlanPage/CreateForm.vue';
import FeaturesContent from '@/components/centralPages/dashboard/subscription/FeaturesContent.vue';
import { useToast } from 'primevue/usetoast';
import Toast from 'primevue/toast';

const openModal = ref(false);
const page = usePage();
const toast = useToast();

const props = defineProps({
    planFeaturesQuery: Object
})

const planFeaturesQuery = toRef(props, 'planFeaturesQuery')

function handlerPaginationFeature(page) {
    return router.get(route('plan_feature.table'), {
        page: page
    }, {
        preserveScroll: true,
    })
}

watch(() => page.props.flash?.message, (val) => {
    toast.add({
        severity: "success",
        summary: "info",
        detail: val,
        life: 3000
    })
})

provide('visibleModal', openModal)
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
