<script setup>
import { Link, router, usePage } from "@inertiajs/vue3";
import { route } from "ziggy-js";
import Modal from "@components/ui/modal/Index.vue";
import MembershipLayout from "@pages/dashboard/tenant_page/membership_page/MembershipLayout.vue";
import DataTable from "primevue/datatable";
import FeatureForm from "./FeatureForm.vue";
import { toRef } from "vue";
import Column from "primevue/column";
import Badge from "primevue/badge";
import TablePagination from "@components/elements/pagination/TablePagination.vue";

const page = usePage();
const membershipFeatures = toRef(() => page.props.membershipFeatures);
const closeModalHandler = () => {
    router.visit(route("tenant-dashboard.membership.feature-page"), {
        replace: true,
    });
};

const paginationFeature = (page) => {
    router.visit(
        route("tenant-dashboard.membership.feature-page", {
            page: page,
        }),
        {
            method: "get",
            preserveScroll: true,
        },
    );
};

const deleteFeatureHandler = (id) => {
    const isConfirmDelete = confirm("Are you sure delete this feature ?");

    if (isConfirmDelete) {
        router.visit(
            route("tenant-dashboard.membership.delete-feature", {
                membershipFeature: id,
            }),
            {
                method: "delete",
                replace: true,
                only: ["flash", "membershipFeatures"],
            },
        );
    }
};
</script>

<style scoped>
.action_lists {
    @apply flex gap-x-6 items-center;

    .action_link {
        @apply text-base bg-primary-700 p-3 rounded;

        &:hover {
            @apply bg-primary-600;
        }
    }
}
</style>

<template>
    <MembershipLayout>
        <header class="px-6 py-6 w-full">
            <Link
                :href="route('tenant-dashboard.membership.feature-page')"
                :only="['modalCreate']"
                as="button"
                class="bg-surface-600 px-4 py-3 rounded-lg flex items-center gap-x-2"
            >
                <i class="pi pi-plus"></i>
                <span>Create Feature</span>
            </Link>
        </header>

        <div v-if="membershipFeatures.data.length > 0">
            <DataTable
                :value="membershipFeatures.data"
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
                <Column header="Title">
                    <template #body="slotProps">
                        <span>{{ slotProps.data.title }}</span>
                    </template>
                </Column>
                <Column header="Assigned plan">
                    <template #body="slotProps">
                        <span>{{ slotProps.data.membership_plans_count }}</span>
                    </template>
                </Column>
                <Column header="Status">
                    <template #body="slotProps">
                        <Badge
                            :value="slotProps.data.status"
                            :severity="
                                slotProps.data.status === 'ACTIVE'
                                    ? 'success'
                                    : 'danger'
                            "
                            class="w-[30%]"
                        />
                    </template>
                </Column>
                <Column header="Action">
                    <template #body="slotProps">
                        <ul class="action_lists">
                            <li class="action_item">
                                <Link
                                    class="action_link"
                                    :only="['modalEdit', 'getMembershipDetail']"
                                    :href="
                                        route(
                                            'tenant-dashboard.membership.feature-page',
                                            {
                                                id: slotProps.data.id,
                                            },
                                        )
                                    "
                                >
                                    <i class="pi pi-pencil"></i>
                                </Link>
                            </li>
                            <li class="action_item">
                                <Link
                                    as="button"
                                    class="!py-[10px] action_link"
                                    @click="
                                        () =>
                                            deleteFeatureHandler(
                                                slotProps.data.id,
                                            )
                                    "
                                >
                                    <i class="pi pi-trash"></i>
                                </Link>
                            </li>
                        </ul>
                    </template>
                </Column>
            </DataTable>

            <div class="mt-6" v-if="membershipFeatures.total > 5">
                <TablePagination
                    :pagination="membershipFeatures"
                    @loadPage="paginationFeature"
                />
            </div>
        </div>
    </MembershipLayout>

    <Modal
        title="Create Membership Feature"
        :modal-visible="page.props.modalCreate"
        @close-modal="closeModalHandler"
    >
        <FeatureForm />
    </Modal>
    <Modal
        title="Edit Membership Feature"
        :modal-visible="page.props.modalEdit"
        @close-modal="closeModalHandler"
    >
        <FeatureForm mode="edit" />
    </Modal>
</template>
