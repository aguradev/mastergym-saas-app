<script setup>
import { provide, ref, toRef } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import PlanTenantsLayout from '@layouts/PlanTenantsLayout.vue';
import TablePagination from '@components/elements/pagination/TablePagination.vue';
import PrimaryButton from '@components/elements/button/PrimaryButton.vue';
import CreateForm from '@pages/dashboard/central_page/subscription_page/features_plan_page/CreateForm.vue';
import FeaturesContent from '@components/centralPages/dashboard/subscription/FeaturesContent.vue';

const openModal = ref(false);

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

</script>

<template>
    <PlanTenantsLayout>
        <CreateForm />

        <div class="p-8">
            <PrimaryButton icon="pi pi-plus" label="Add Feature" @click-event="() => openModal = true" />
        </div>

        <section class="pb-12">
            <FeaturesContent :featurePlanDatas="planFeaturesQuery" />
            <TablePagination v-if="!!planFeaturesQuery.data.length" :pagination="planFeaturesQuery"
                @load-page="handlerPaginationFeature" />
        </section>
    </PlanTenantsLayout>
</template>
