<script setup>
    import { computed, inject } from 'vue';
    import Dialog from 'primevue/dialog';

    const props = defineProps({
        image: String,
    });

    const visible = inject('visibleModal');
    const emits = defineEmits(['closeModal']);

    let img = computed(() => {
        return new URL(`${props.image}`, import.meta.url).href;
    });
</script>

<template>
    <Dialog
        v-model:visible="visible"
        :style="{
            width: '90rem',
        }"
        :pt="{
            header: {
                class: ['flex items-center justify-between', 'shrink-0', 'p-6', 'border-t-0', 'rounded-tl-lg', 'rounded-tr-lg', 'bg-primary-800 dark:bg-primary-800', 'text-surface-700 dark:text-surface-0/80'],
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
                        'rounded-br-lg': !instance.$slots.footer,
                    },
                    // Colors
                    'bg-primary-900 dark:bg-primary-800',
                    'text-surface-700 dark:text-surface-0/80',
                    // Misc
                    'overflow-y-auto',
                ],
            }),
            footer: {
                class: ['flex items-center justify-end', 'shrink-0', 'text-right', 'gap-2', 'px-6', 'pb-6', 'border-t-0', 'rounded-b-lg', 'bg-primary-900 dark:bg-primary-800', 'text-surface-700 dark:text-surface-0/80'],
            },
            mask: {
                class: 'bg-primary-900/70 px-6',
            },
        }"
        modal
        header="Preview Footer Website Layout"
    >
        <div>
            <img
                :src="img"
                alt=""
                class="max-h-[520px] m-auto"
            />
            <p class="text-sm pt-2">*This is only a static preview of the default layout, and does not represent the current content that is displayed on the live website*</p>
        </div>
    </Dialog>
</template>
