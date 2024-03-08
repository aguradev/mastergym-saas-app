<script setup>
import Divider from 'primevue/divider';
import Card from '@/elements/card/main_card.vue';
import Badge from 'primevue/badge';
import Button from 'primevue/button';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import DashboardLayout from '@/layouts/DashboardLayout.vue';

import { onMounted, ref, computed } from 'vue';
import { useNavMainPlatform } from '@/stores/navigation_menu_item';
import { storeToRefs } from 'pinia';
import { Head } from '@inertiajs/vue3';

const getNavMainPlatform = useNavMainPlatform()
const { navigationMenuItem } = storeToRefs(getNavMainPlatform)
const props = defineProps(["tenant_latests"]);
const tenantLatests = ref([])

const addNumberInTenantLatests = computed(() => {
    if (tenantLatests.value.length > 0) {
        return tenantLatests.value.map((item, index) => {
            return item = { no: index + 1, ...item }
        })
    }
})

onMounted(() => {
    getNavMainPlatform.updateMenusItemActive(route(route().current()))
    tenantLatests.value = [...props.tenant_latests]
    console.log(addNumberInTenantLatests.value)
})

</script>

<style scoped>
figure {
    .icon {
        @apply bg-surface-900 py-3 px-4 rounded-full;

        i {
            @apply text-2xl;
        }
    }

    .content__caption {
        .title__content {
            @apply text-base font-medium mb-2
        }

        .subtitle__content {
            @apply text-2xl font-bold
        }
    }
}
</style>

<template>

    <Head>
        <title>Dashboard</title>
    </Head>

    <DashboardLayout :menu-items="navigationMenuItem" titleNav="Overview">
        <template #main_content>
            <section class="flex gap-x-6">
                <div class="min-w-[60%] flex flex-col gap-y-8">
                    <Card>
                        <template #card__title>
                            <h3 class="mb-6">Recent Data</h3>
                        </template>
                        <template #card__content>
                            <div class="flex items-center justify-between">
                                <figure class="inline-flex items-center gap-x-6 border-surface-900">
                                    <div class="icon">
                                        <i class="pi pi-users"></i>
                                    </div>
                                    <div class="content__caption">
                                        <h4 class="title__content">Owner Joined</h4>
                                        <p class="subtitle__content">14</p>
                                    </div>
                                    <div class="px-4">
                                        <Divider layout="vertical" align="center" />
                                    </div>
                                </figure>
                                <figure class="inline-flex items-center gap-x-6 border-surface-900">
                                    <div class="icon">
                                        <i class="pi pi-building"></i>
                                    </div>
                                    <div class="content__caption">
                                        <h4 class="title__content">GYM vendor</h4>
                                        <p class="subtitle__content">20</p>
                                    </div>
                                    <div class="px-4">
                                        <Divider layout="vertical" align="center" />
                                    </div>
                                </figure>
                                <figure class="inline-flex items-center gap-x-6 border-surface-900">
                                    <div class="icon">
                                        <i class="pi pi-building"></i>
                                    </div>
                                    <div class="content__caption">
                                        <h4 class="title__content">Subscriptions</h4>
                                        <p class="subtitle__content">3</p>
                                    </div>
                                </figure>
                            </div>
                        </template>
                    </Card>

                    <Card>
                        <template #card__title>
                            <h3 class="mb-6">Tenant Latest</h3>
                        </template>

                        <template #card__content>
                            <DataTable :value="addNumberInTenantLatests" :pt="{
        bodyrow: 'odd:bg-primary-950 even:bg-primary-900',
        column: {
            headercell: 'p-4 bg-surface-800',
            headercontent: 'text-center',
            bodycell: 'p-5 text-center',
        }
    }">
                                <Column field="no" header="No" bodyClass="bg-transparent" />
                                <Column field="vendor" header="Vendor" />
                                <Column field="domain" header="Domain" />
                            </DataTable>
                        </template>
                    </Card>
                </div>

                <div class="min-w-[40%]">
                    <Card>
                        <template #card__title>
                            <h3 class="mb-6">Latest Transactions</h3>
                        </template>

                        <template #card__content>
                            <div class="flex flex-col gap-y-6">
                                <figure class="flex flex-col p-5 rounded-lg gap-y-6 bg-primary-900">
                                    <header class="flex flex-col gap-y-2">
                                        <h6 class="text-base">Gold Feature</h6>
                                        <p class="text-sm text-white/50">Christian Hendorsen</p>
                                    </header>

                                    <figcaption>
                                        <Badge value="Pending" severity="info" class="w-[16%]" />
                                    </figcaption>
                                </figure>
                                <figure class="flex flex-col p-5 rounded-lg gap-y-6 bg-primary-900">
                                    <header class="flex flex-col gap-y-2">
                                        <h6 class="text-base">Silver Feature</h6>
                                        <p class="text-sm text-white/50">Christian Hendorsen</p>
                                    </header>

                                    <figcaption>
                                        <Badge value="Pending" severity="info" class="w-[16%]" />
                                    </figcaption>
                                </figure>
                                <figure class="flex flex-col p-5 rounded-lg gap-y-6 bg-primary-900">
                                    <header class="flex flex-col gap-y-2">
                                        <h6 class="text-base">Bronze Feature</h6>
                                        <p class="text-sm text-white/50">Christian Hendorsen</p>
                                    </header>

                                    <figcaption>
                                        <Badge value="Pending" severity="info" class="w-[16%]" />
                                    </figcaption>
                                </figure>
                            </div>

                            <div class="mt-6">
                                <Button
                                    :pt="{ root: 'bg-primary-900 px-5 py-3 rounded-lg text-white hover:bg-primary-700' }">
                                    <a href="#" class="font-bold">More detail</a>
                                </Button>
                            </div>
                        </template>
                    </Card>
                </div>

            </section>
        </template>
    </DashboardLayout>
</template>
