<script setup>
import { ref, toRef } from 'vue';
import { router } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import SubscriptionsLayout from '@/components/layouts/SubscriptionsLayout.vue';
import TablePagination from '@/components/elements/pagination/TablePagination.vue';
import PrimaryButton from '@/components/elements/button/PrimaryButton.vue';
import CreateForm from './createForm.vue';
import FeaturesContent from '@/components/centralPages/dashboard/subscription/FeaturesContent.vue';

const openModal = ref(false);

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

function setRouteUrl(id) {
    return route('plan_feature.edit-form', { tenantPlanFeature: id })
}

</script>

<template>
    <SubscriptionsLayout>
        {{ $page.props.flash?.message }}
        <CreateForm :open-modal="openModal" @closeModal="() => openModal = false" v-if="openModal" />

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
