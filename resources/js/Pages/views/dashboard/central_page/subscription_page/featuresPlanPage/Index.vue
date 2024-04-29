<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import SubscriptionsLayout from '@/layouts/SubscriptionsLayout.vue';
import Dialog from 'primevue/dialog';
import FeaturesContent from '@/components/centralPages/dashboard/subscription/FeaturesContent.vue';
import PrimaryButton from '@/elements/button/PrimaryButton.vue';
import TablePagination from '@/elements/pagination/TablePagination.vue';

const props = defineProps({
    planFeaturesQuery: Object
})
const planFeaturesQuery = ref(props.planFeaturesQuery)

function handlerPaginationFeature(page) {
    return router.get(route('plan_feature.table'), {
        page: page
    }, {
        preserveScroll: true,
    })
}
</script>

<template>
    <SubscriptionsLayout>

        <div class="p-6">
            <PrimaryButton label="Add Feature" icon="pi pi-plus" />
        </div>

        <section class="pb-12">
            <FeaturesContent :featurePlanDatas="planFeaturesQuery" />
            <div v-if="!!planFeaturesQuery.data.length">
                <TablePagination :pagination="planFeaturesQuery" @load-page="handlerPaginationFeature" />
            </div>
        </section>
    </SubscriptionsLayout>
</template>
