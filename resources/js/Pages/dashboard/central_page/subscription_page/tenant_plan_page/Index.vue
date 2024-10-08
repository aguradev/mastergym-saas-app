<script setup>
import { defineAsyncComponent, ref, toRef, watch } from "vue";
import PlanTenantsLayout from "@layouts/PlanTenantsLayout.vue";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import ActionLists from "@components/elements/ulLists/ActionLists.vue";
import PrimaryButton from "@components/elements/button/PrimaryButton.vue";
import Modal from "@components/ui/modal/Index.vue";
import ModalSidebar from "@components/ui/sidebar/ModalSidebar.vue";
import CreateForm from "@pages/dashboard/central_page/subscription_page/tenant_plan_page/CreateForm.vue";
import NotFound from "@components/ui/cta/NotFound.vue";
import FormatCurrency from "@lib/Currency";
import LoadingSkeleton from "@components/ui/loading/Skeleton.vue";
import { router, usePage } from "@inertiajs/vue3";
import { route } from "ziggy-js";
import TenantPlanEditForm from "./EditForm.vue";

const LazyPlanDetail = defineAsyncComponent({
    loader: () => import("./PlanDetail.vue"),
});

const LazyNewVersionPlan = defineAsyncComponent({
    loader: () => import("./NewVersionForm.vue"),
});

const props = defineProps({
    getTenantPlanData: Array,
});

const page = usePage();
const dataSubscriptions = toRef(() => props.getTenantPlanData);
const createModalVisible = ref(false);
const detailModalVisible = ref(false);
const tenantPlanId = ref(null);
const tenantVersionPlanId = ref(null);
const refreshDetailTenantSuspense = ref(false);
const newVersionFormActive = ref(false);

const openDetailPlan = (id) => {
    detailModalVisible.value = true;
    tenantPlanId.value = id;
};

const changeDetailToFormSuspense = () => {
    refreshDetailTenantSuspense.value = true;
    newVersionFormActive.value = true;
};

const changeVersionHandler = (id) => {
    refreshDetailTenantSuspense.value = true;
    tenantVersionPlanId.value = id;
};

const editActionHandler = (id) => {
    router.visit(
        route("plan_tenant.table", {
            id: id,
        }),
        {
            method: "get",
            preserveState: true,
            only: [
                "getTenantDetail",
                "getPlanFeatures",
                "openModalEdit",
                "getPlanVersions",
            ],
        },
    );
};

const closeModalHandler = () => {
    router.visit(route("plan_tenant.table"), {
        method: "get",
        replace: true,
    });
};

watch(
    () => refreshDetailTenantSuspense.value,
    (newState) => {
        if (newState) {
            setTimeout(() => {
                refreshDetailTenantSuspense.value = false;
            }, 500);
        }
    },
);
</script>

<template>
    <PlanTenantsLayout>
        <section class="p-8">
            <PrimaryButton
                icon="pi pi-plus"
                label="Add Plan Subscription"
                @click-event="() => (createModalVisible = true)"
            />
        </section>

        <NotFound
            caption="Tenant plan is empty"
            v-if="dataSubscriptions.length <= 0"
        />

        <section
            class="table_subscriptions"
            v-if="dataSubscriptions.length > 0"
        >
            <DataTable
                :value="dataSubscriptions"
                :pt="{
                    bodyrow:
                        'bg-transparent last:border-none border-b border-primary-700 odd:bg-primary-800',
                    column: {
                        headercell: 'py-6 px-12 border-b border-primary-600',
                        headercontent:
                            'text-left font-[300] tracking-wide text-white/50',
                        bodycell: 'px-12 py-6 text-base',
                    },
                }"
            >
                <Column header="Plans">
                    <template #body="slotProps">
                        <div>{{ slotProps.data.name }}</div>
                    </template>
                </Column>
                <Column header="Price">
                    <template #body="slotProps">
                        <ul class="flex flex-col gap-y-4">
                            <li>
                                {{
                                    FormatCurrency(
                                        slotProps.data.tenant_version_latest
                                            .price_per_month,
                                    )
                                }}
                            </li>
                            <li>
                                {{
                                    FormatCurrency(
                                        slotProps.data.tenant_version_latest
                                            .price_per_year,
                                    )
                                }}
                            </li>
                        </ul>
                    </template>
                </Column>
                <Column header="Feature count">
                    <template #body="slotProps">
                        <div>
                            {{
                                slotProps.data.tenant_version_latest
                                    .plan_features_count
                            }}
                            Features
                        </div>
                    </template>
                </Column>
                <Column header="Latest version">
                    <template #body="slotProps">
                        <div>
                            v.{{ slotProps.data.tenant_version_latest.version }}
                        </div>
                    </template>
                </Column>
                <Column header="Actions">
                    <template #body="slotProps">
                        <ActionLists
                            @detailEvent="openDetailPlan(slotProps.data.id)"
                            @editEvent="editActionHandler(slotProps.data.id)"
                        />
                    </template>
                </Column>
            </DataTable>
        </section>
    </PlanTenantsLayout>

    <ModalSidebar
        :modal-visible="detailModalVisible"
        title="Plan detail"
        @close-modal="
            () => {
                detailModalVisible = false;
                tenantPlanId = null;
                newVersionFormActive = false;
            }
        "
    >
        <Suspense v-if="!refreshDetailTenantSuspense">
            <template #default>
                <div v-if="!newVersionFormActive">
                    <LazyPlanDetail
                        :id="tenantPlanId"
                        :versionPlanId="tenantVersionPlanId"
                        @new-version-event="changeDetailToFormSuspense"
                        @selectVersionEvent="changeVersionHandler"
                    />
                </div>
                <div v-else-if="newVersionFormActive">
                    <LazyNewVersionPlan :id="tenantPlanId" />
                </div>
            </template>

            <template #fallback>
                <LoadingSkeleton />
            </template>
        </Suspense>
    </ModalSidebar>

    <Modal
        title="Create tenant subscription plan"
        :modal-visible="createModalVisible"
        @close-modal="() => (createModalVisible = false)"
    >
        <CreateForm />
    </Modal>

    <Modal
        title="Edit tenant subscription plan"
        :modal-visible="page.props.openModalEdit"
        @close-modal="closeModalHandler"
    >
        <TenantPlanEditForm />
    </Modal>
</template>
