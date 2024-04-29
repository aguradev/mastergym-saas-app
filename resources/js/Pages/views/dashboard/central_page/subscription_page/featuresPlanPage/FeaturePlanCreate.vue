<script setup>
import { toRefs } from 'vue'
import Dialog from 'primevue/dialog';
import FeaturePlanForms from '@/components/centralPages/dashboard/subscription/forms/FeaturePlanForm.vue';

const props = defineProps({
    openModal: {
        type: Boolean,
        default: false
    }
})

const { openModal } = toRefs(props)

function handlerCreateFeature(form) {
    form.post(route("plan_feature.create"), {
        onSuccess: () => {
            router.visit(route('plan_feature.table'));
        },
    })
}
</script>

<template>
    <Dialog v-model:visible="openModal" :style="{
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
        <FeaturePlanForms @action-feature-form="handlerCreateFeature" :validation-messages="validationFormFeatures" />
    </Dialog>
</template>
