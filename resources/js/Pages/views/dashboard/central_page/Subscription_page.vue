<script setup>
import { onMounted, defineAsyncComponent, ref, watch } from 'vue';
import DashboardLayout from '@/layouts/DashboardLayout.vue';
import { Head } from '@inertiajs/vue3';

import { useNavMainPlatform } from '@/stores/navigation_menu_item';
import { storeToRefs } from 'pinia';

import TabView from 'primevue/tabview';
import TabPanel from 'primevue/tabpanel'
import Button from 'primevue/button'

const getNavMainPlatform = useNavMainPlatform()
const { updateMenusItemActive } = getNavMainPlatform
const { navigationMenuItem } = storeToRefs(getNavMainPlatform)

const PlanTable = defineAsyncComponent({
    loader: () => import('@dashboardCentralPageComponents/subscription/PlanTable.vue'),
})

const AnaliyticsPage = defineAsyncComponent({
    loader: () => import('@dashboardCentralPageComponents/subscription/AnaliyticsContent.vue')
})

const FeaturesPage = defineAsyncComponent({
    loader: () => import('@dashboardCentralPageComponents/subscription/FeaturesContent.vue')
})

const tabsContent = ref([
    { title: "Analiytics", content: AnaliyticsPage, isActive: true },
    { title: "Plans Table", content: PlanTable, isActive: false },
    { title: "Features Table", content: FeaturesPage, isActive: false }
])

const contentTabActive = ref(0)

onMounted(() => {
    updateMenusItemActive(route(route().current()))
})

watch(contentTabActive, (stateNow, prevState) => {
    if (prevState) {
        tabsContent.value[prevState].isActive = false
    }
    tabsContent.value[stateNow].isActive = true
})

</script>

<template>

    <Head title="Subscription" />

    <DashboardLayout :menu-items="navigationMenuItem" titleNav="Subscription Management">
        <template #main_content>

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
            }" v-model:activeIndex="contentTabActive">

                <TabPanel v-for="(tab) in tabsContent" :key="tab.title" :header="tab.title">
                    <Suspense v-if="tab.isActive">
                        <template #default>
                            <component :is="tab.content"></component>
                        </template>

                        <template #fallback>
                            <div>
                                loading...
                            </div>
                        </template>
                    </Suspense>
                </TabPanel>

            </TabView>

        </template>
    </DashboardLayout>
</template>
