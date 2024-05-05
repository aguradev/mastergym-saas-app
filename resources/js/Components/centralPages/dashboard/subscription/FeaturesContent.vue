<script setup>
import { ref, toRef, watch } from 'vue';
import { route } from 'ziggy-js'

import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ActionLists from '@components/elements/ulLists/ActionLists.vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    featurePlanDatas: Object
})

const selectedCheckboxFeature = ref([]);

const featurePlanDatas = toRef(props, 'featurePlanDatas')

const getNumberColumn = (current_page, per_page, index) => {
    return (current_page - 1) * per_page + (index + 1)
}

const deleteFeaturePlanHandler = (id) => {
    router.delete(route('plan_feature.delete', {
        tenantPlanFeature: id
    }), {
        onBefore: () => {
            confirm("are you sure delete features ? ")
        },
        onFinish: () => {
            selectedCheckboxFeature.value = [];
        },
        preserveScroll: true
    })
}

watch(selectedCheckboxFeature, (newState) => {
    console.log(newState);
})

</script>

<template>
    <section class="pb-12">

        <div v-if="!!featurePlanDatas.data.length">
            <DataTable :value="featurePlanDatas.data" :pt="{
                bodyrow: 'bg-transparent last:border-none border-b border-primary-700 odd:bg-primary-800',
                column: {
                    headercell: 'py-6 px-12 border-b border-primary-600',
                    headercontent: 'text-left font-[300] tracking-wide text-white/50',
                    bodycell: 'px-12 py-6 text-base',
                }
            }">
                <Column header="">
                    <template #body="slotProps">
                        <input type="checkbox" v-model="selectedCheckboxFeature" :value="slotProps.data.id"
                            class="block rounded-md size-4" :id="`checkbox-${slotProps.data.id}`" />
                    </template>
                </Column>
                <Column header="No">
                    <template #body="slotProps">
                        <div>
                            {{ getNumberColumn(featurePlanDatas.current_page, featurePlanDatas.per_page,
                                slotProps.index)
                            }}
                        </div>
                    </template>
                </Column>
                <Column header="Feature">
                    <template #body="slotProps">
                        <div>{{ slotProps.data.name }}</div>
                    </template>
                </Column>
                <Column header="Created At">
                    <template #body="slotProps">
                        <div>{{ slotProps.data.created_at_diff_human }}</div>
                    </template>
                </Column>
                <Column header="Updated At">
                    <template #body="slotProps">
                        <div>{{ slotProps.data.updated_at ?? '-' }}</div>
                    </template>
                </Column>
                <Column header="Action">
                    <template #body="slotProps">
                        <ActionLists @deleteEvent="deleteFeaturePlanHandler(slotProps.data.id)"
                            :editRoute="route('plan_feature.edit-form', { tenantPlanFeature: slotProps.data.id })" />
                    </template>
                </Column>
            </DataTable>
        </div>
        <div v-else>
            <p>No Features Plan</p>
        </div>
    </section>
</template>
