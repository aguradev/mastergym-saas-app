<script setup>
import { toRef } from 'vue';
import { router } from '@inertiajs/vue3';
import SubscriptionsLayout from '@/components/layouts/SubscriptionsLayout.vue';
import FeaturesContent from '@/components/centralPages/dashboard/subscription/FeaturesContent.vue';
import PrimaryButton from '@/components/elements/button/PrimaryButton.vue';
import TablePagination from '@/components/elements/pagination/TablePagination.vue';

const props = defineProps({
    planFeaturesQuery: Object
})
const planFeaturesQuery = toRef(() => props.planFeaturesQuery)

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
            <TablePagination v-if="!!planFeaturesQuery.data.length" :pagination="planFeaturesQuery"
                @load-page="handlerPaginationFeature" />
        </section>
    </SubscriptionsLayout>
</template>
