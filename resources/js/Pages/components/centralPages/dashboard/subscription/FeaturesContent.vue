<script setup>
import { ref, onMounted, watch, toRef } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import Card from '@/elements/card/DefaultCard.vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
const featurePlanData = ref([])
const page = usePage()

async function refreshLoading() {
    router.reload({
        only: ['planFeatures']
    })

    await new Promise((res) => {
        setTimeout(() => res(true), 1000)
    })
}

async function loadFetchFeaturePlans() {
    return await new Promise((res, reject) => {
        const { planFeatures } = page.props
        if (planFeatures !== undefined) {
            res(planFeatures)
        } else {
            reject("no features plan data")
        }
    })
}

onMounted(async () => {
    featurePlanData.value = [...await loadFetchFeaturePlans()] || []
})

await refreshLoading();

</script>
<template>
    <section>

        <div v-if="featurePlanData.length > 0">
            <Card>
                <template #card__title>Tables</template>
                <template #card__content>
                    <DataTable :value="featurePlanData" :pt="{
                        bodyrow: 'bg-transparent last:border-none border-b border-primary-700',
                        column: {
                            headercell: 'py-6 px-4 border-b border-primary-600',
                            headercontent: 'text-left font-[300] tracking-wide text-white/50',
                            bodycell: 'p-5',
                        }
                    }">
                        <Column header="No">
                            <template #body="slotProps">
                                <div>{{ slotProps.index + 1 }}</div>
                            </template>
                        </Column>
                        <Column header="Feature">
                            <template #body="slotProps">
                                <div>{{ slotProps.data.name }}</div>
                            </template>
                        </Column>
                        <Column header="Created date">
                            <template #body="slotProps">
                                <div>{{ slotProps.data.created_at }}</div>
                            </template>
                        </Column>
                        <Column header="Updated date">
                            <template #body="slotProps">
                                <div>{{ slotProps.data.updated_at ?? '-' }}</div>
                            </template>
                        </Column>
                    </DataTable>
                </template>
            </Card>
        </div>
    </section>
</template>
