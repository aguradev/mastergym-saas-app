<script setup>
import SettingPage from "./SettingPage.vue";
import DynamicSectionContent from "@components/ui/dynamicDetailContent/Index.vue";
import Badge from "primevue/badge";
import { router, usePage } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import { route } from "ziggy-js";
import { computed, toRef } from "vue";
import TenantConfiguration from "@pages/dashboard/tenant_page/setting_page/form/TenantConfiguration.vue";
import Modal from "@components/ui/modal/Index.vue";
const page = usePage();
const currentTenant = computed(() => page.props.currentTenant);
const closeEditTenantModal = () => {
    router.visit(route("tenant-dashboard.setting-page"), {
        replace: true,
    });
};
</script>

<template>
    <SettingPage>
        <section class="py-6 px-8 bg-primary-800">
            <h2 class="text-xl font-semibold mb-6">Tenant Information</h2>

            <div class="grid grid-cols-[.5fr_1fr] items-start">
                <DynamicSectionContent
                    label="name"
                    :caption="currentTenant.name"
                />
                <DynamicSectionContent
                    label="address"
                    :caption="currentTenant.address"
                />
                <DynamicSectionContent
                    label="email"
                    :caption="currentTenant.email"
                />
                <div class="mb-8">
                    <h4 class="mb-3 text-base font-semibold capitalize">
                        Status
                    </h4>
                    <Badge
                        :value="currentTenant.status"
                        :severity="
                            currentTenant.status === 'ACTIVE'
                                ? 'success'
                                : 'danger'
                        "
                        class="w-[8%]"
                    />
                </div>
                <DynamicSectionContent
                    label="domain"
                    :caption="currentTenant.domains[0].domain"
                />
                <DynamicSectionContent
                    label="Virtual Account number"
                    :caption="currentTenant.virtual_account_number ?? '-'"
                />
            </div>

            <Link
                preserve-state
                as="button"
                :only="['modalEditTenantActive']"
                class="bg-surface-600 px-4 py-3 rounded-lg flex items-center gap-x-2"
            >
                <span>Edit Tenant</span>
            </Link>
        </section>
        <section class="py-6 px-8 bg-primary-800">
            <h2 class="text-xl font-semibold mb-6">Subscription</h2>

            <div class="grid grid-cols-[.5fr_1fr] items-start">
                <DynamicSectionContent
                    label="Start date"
                    :caption="
                        currentTenant.tenant_subscription
                            .date_and_time_start_date
                    "
                />
                <DynamicSectionContent
                    label="Due date"
                    :caption="
                        currentTenant.tenant_subscription.date_and_time_due_date
                    "
                />
                <div class="mb-8">
                    <h4 class="mb-3 text-base font-semibold capitalize">
                        Subscription status
                    </h4>
                    <Badge
                        :value="currentTenant.tenant_subscription.status"
                        :severity="
                            currentTenant.status === 'ACTIVE'
                                ? 'success'
                                : 'danger'
                        "
                        class="w-[15%]"
                    />
                </div>
            </div>
        </section>

        <Modal
            title="Edit tenant"
            :modal-visible="page.props.modalEditTenantActive"
            @close-modal="closeEditTenantModal"
        >
            <TenantConfiguration :tenant-data="currentTenant" />
        </Modal>
    </SettingPage>
</template>
