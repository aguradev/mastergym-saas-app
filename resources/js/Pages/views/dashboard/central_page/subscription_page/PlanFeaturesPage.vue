<script setup>
import SubscriptionsLayout from '@/layouts/SubscriptionsLayout.vue';
import Dialog from 'primevue/dialog';
import FeaturePlanInput from '@/components/centralPages/dashboard/subscription/form/FeaturePlanForm.vue';
import { defineAsyncComponent, ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import PrimaryButton from '@/elements/button/PrimaryButton.vue';

const featureDialogVisible = ref(false)

const FeatureContent = defineAsyncComponent({
    loader: () => import('@/components/centralPages/dashboard/subscription/FeaturesContent.vue')
})

function handlerCreateFeature(form) {
    form.post(route("plan_feature.create"), {
        onSuccess: () => {
            featureDialogVisible.value = false;
            router.visit(route('plan_feature.table'));
        },
    })
}

const routeModalCreate = route('plan_feature.modal-create')

</script>

<template>
    <SubscriptionsLayout>
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
            <FeaturePlanInput @action-feature-form="handlerCreateFeature"
                :validation-messages="validationFormFeatures" />
        </Dialog>

        <div class="p-6">
            <PrimaryButton label="Add Feature" icon="pi pi-plus" @click-event="() => featureDialogVisible = true" />
        </div>

        <Suspense>
            <template #default>
                <section class="pb-12">
                    <FeatureContent />
                </section>
            </template>

            <template #fallback>
                <div>
                    Loading...
                </div>
            </template>
        </Suspense>
    </SubscriptionsLayout>
</template>
