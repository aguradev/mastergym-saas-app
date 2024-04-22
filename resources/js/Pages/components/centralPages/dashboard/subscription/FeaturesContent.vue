<script setup>
import { onMounted, reactive, ref } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import Dialog from 'primevue/dialog';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import TablePagination from '@/elements/pagination/TablePagination.vue';
import ActionLists from '@/elements/ulLists/ActionLists.vue';
import FeaturePlanInput from '@/components/centralPages/dashboard/subscription/form/FeaturePlanForm.vue';
import PrimaryButton from '@/elements/button/PrimaryButton.vue';
const featurePlanData = reactive({
    data: [],
    links: [],
    current_page: 0,
    next_page_url: null,
    prev_page_url: null,
    last_page_url: null,
    total_page: 0,
    per_page: 0
})
const page = usePage()
const featureDialogVisible = ref(false)


async function refreshLoading() {
    const { tab, page } = route().params
    router.replace(`/dashboard/subscription?tab=FeaturesTable&page=${page !== undefined ? page : 1}`, {
        only: ['planFeatures'],
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
    const { data, links, current_page, per_page, total, next_page_url, last_page_url } = await loadFetchFeaturePlans()
    featurePlanData.data = [...data]
    featurePlanData.per_page = per_page
    featurePlanData.next_page_url = next_page_url
    featurePlanData.last_page_url = last_page_url
    featurePlanData.total_page = total
    featurePlanData.current_page = current_page
    featurePlanData.links = [...links]
})

await refreshLoading();

</script>
<template>
    <section>
        <Dialog v-model:visible="featureDialogVisible" :style="{
            width: '40rem',
        }" :pt="{
            header: {
                class: ['flex items-center justify-between', 'shrink-0', 'p-6', 'border-t-0', 'rounded-tl-lg', 'rounded-tr-lg', 'bg-prmary-0 dark:bg-primary-800', 'text-surface-700 dark:text-surface-0/80']
            },
            content: ({ state, instance }) => ({
                class: [
                    // Spacing
                    'px-6',
                    'pb-8',
                    'pt-0',
                    // Shape
                    {
                        grow: state.maximized,
                        'rounded-bl-lg': !instance.$slots.footer,
                        'rounded-br-lg': !instance.$slots.footer
                    },
                    // Colors
                    'bg-primary-0 dark:bg-primary-800',
                    'text-surface-700 dark:text-surface-0/80',
                    // Misc
                    'overflow-y-auto'
                ]
            }),
            footer: {
                class: ['flex items-center justify-end', 'shrink-0', 'text-right', 'gap-2', 'px-6', 'pb-6', 'border-t-0', 'rounded-b-lg', 'bg-primary-0 dark:bg-primary-800', 'text-surface-700 dark:text-surface-0/80']
            },
            mask: {
                class: 'bg-primary-900/70 px-6',
            }
        }" modal header="Feature Create">
            <FeaturePlanInput />
        </Dialog>

        <div class="p-6">
            <PrimaryButton type="button" label="Add" icon="pi pi-external-link"
                @click-event="() => featureDialogVisible = true" />
        </div>

        <div v-if="!!featurePlanData.data.length">
            <DataTable :value="featurePlanData.data" :pt="{
                bodyrow: 'bg-transparent last:border-none border-b border-primary-700 odd:bg-primary-800',
                column: {
                    headercell: 'py-6 px-12 border-b border-primary-600',
                    headercontent: 'text-left font-[300] tracking-wide text-white/50',
                    bodycell: 'px-12 py-6 text-base',
                }
            }">
                <Column header="No">
                    <template #body="slotProps">
                        <div>{{ (featurePlanData.current_page - 1) * featurePlanData.per_page + (slotProps.index + 1) }}
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
                        <ActionLists />
                    </template>
                </Column>
            </DataTable>

            <TablePagination :links="featurePlanData.links" />
        </div>
        <div v-else>
            <p>No Features Plan</p>
        </div>
    </section>
</template>
