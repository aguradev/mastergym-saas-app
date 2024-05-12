<script setup>
import { onMounted, ref, defineAsyncComponent, onUnmounted } from 'vue';
import { Head } from '@inertiajs/vue3';
import { useNavMainPlatform } from "@stores/navigation_menu_item";
import { useMenuUser } from "@stores/menu_dropdown_user";
import { storeToRefs } from 'pinia';
import Divider from 'primevue/divider';
import Card from '@components/elements/card/DefaultCard.vue';
import DashboardLayout from '@layouts/DashboardLayout.vue';
import TenantLatestSection from '@dashboardCentralPageComponents/mainMenu/tenantLatest_section.vue';
import LatestTransactionSubscriptionSection from '@dashboardCentralPageComponents/mainMenu/LatestTransactionSubscription_section.vue';

const props = defineProps([
    "tenantLatest",
    "tenantCount"
]);
const { tenantLatest } = props
const tenantLatests = ref([...tenantLatest])

const getNavMainPlatform = useNavMainPlatform();
const storeMenuUser = useMenuUser();
const { isMenuItemActive } = storeMenuUser;
const { navigationMenuItem, menuItemActive } = storeToRefs(getNavMainPlatform);
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

    <DashboardLayout :menu-items="navigationMenuItem" :menu-item-active="menuItemActive" titleNav="Overview">
        <template #main_content>
            <section class="flex p-8 gap-x-4">
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
                                        <h4 class="title__content">Owner Tenant</h4>
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
                                        <h4 class="title__content">Tenant Collection</h4>
                                        <p class="subtitle__content">{{ tenantCount }}</p>
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

                    <TenantLatestSection :dataTenants="tenantLatests" />
                </div>

                <div class="min-w-[40%]">
                    <LatestTransactionSubscriptionSection />
                </div>

            </section>
        </template>
    </DashboardLayout>
</template>
