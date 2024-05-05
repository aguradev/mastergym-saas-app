<script setup>
import TabView from 'primevue/tabview'
</script>

<template>
    <TabView pt:nav="flex flex-1 bg-transparent list-none p-0 m-0 border-b-2 dark:border-primary-700" :pt="{
        tabpanel: {
            headerAction: ({ parent, context }) => ({
                class: ['bg-transparent', 'relative',
                    // Font
                    'font-bold',
                    // Flexbox and Alignment
                    'flex items-center',
                    // Spacing
                    'p-5',
                    '-mb-[2px]',
                    // Shape
                    'border-b-2',
                    'rounded-t-md',
                    {
                        'border-b-2 border-transparent': parent.state.d_activeIndex !== context.index,
                        'bg-transparent font-normal': parent.state.d_activeIndex !== context.index,
                        'text-surface-700 dark:text-surface-0/80': parent.state.d_activeIndex !== context.index,
                        'bg-transparent': parent.state.d_activeIndex === context.index,
                        'border-surface-400 dark:border-surface-400': parent.state.d_activeIndex === context.index,
                        'text-white dark:text-white': parent.state.d_activeIndex === context.index
                    },
                    {
                        'hover:text-white': parent.state.d_activeIndex !== context.index,
                        'hover:border-surface-400 dark:hover:border-surface-400': parent.state.d_activeIndex !== context.index
                    },
                    'focus-visible:outline-none focus-visible:outline-offset-0 focus-visible:ring focus-visible:ring-inset',
                    'transition-all duration-200',
                    'cursor-pointer select-none text-decoration-none',
                    'user-select-none',
                    'overflow-hidden'
                ]
            }),
            content: {
                class: ['bg-transparent py-5 border-0']
            }
        }
    }">

        <slot name="tabContent" />

    </TabView>
</template>
