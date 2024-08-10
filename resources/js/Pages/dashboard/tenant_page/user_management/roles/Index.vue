<script setup>
import { usePage, Link, router } from "@inertiajs/vue3";
import { toRef } from "vue";
import { route } from "ziggy-js";
import UserManagementLayout from "@pages/dashboard/tenant_page/user_management/Index.vue";
import Modal from "@components/ui/modal/Index.vue";
import RoleForm from "./RoleForm.vue";

import Column from "primevue/column";
import DataTable from "primevue/datatable";

const page = usePage();
const rolesData = toRef(() => page.props.rolesDatas);
const superAdminCount = toRef(() => page.props.superAdminCount);
const staffCount = toRef(() => page.props.staffCount);
const memberCount = toRef(() => page.props.memberCount);

const closeModalHandler = () => {
    router.visit(route("tenant-dashboard.user-management.roles"), {
        replace: true,
    });
};

const deleteActionHandler = (id) => {
    const confirmDelete = confirm("Are you sure delete this role ?");

    if (confirmDelete) {
        router.visit(
            route("tenant-dashboard.user-management.delete-role", {
                id: id,
            }),
            {
                only: ["rolesDatas", "flash"],
                method: "delete",
                replace: true,
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
    <UserManagementLayout>
        <header class="px-6 py-6 w-full">
            <Link
                :to="route('tenant-dashboard.user-management.users')"
                preserve-state
                :only="['modalCreate']"
                as="button"
                class="bg-surface-600 px-4 py-3 rounded-lg flex items-center gap-x-2"
            >
                <i class="pi pi-plus"></i>
                <span>Create Roles</span>
            </Link>
        </header>
        <div v-if="rolesData.data.length > 0">
            <DataTable
                :value="rolesData.data"
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
                <Column header="Role">
                    <template #body="slotProps">
                        <div class="flex items-center gap-4">
                            <span class="text-nowrap">{{
                                slotProps.data.name
                            }}</span>
                        </div>
                    </template>
                </Column>
                <Column header="Assigned users">
                    <template #body="slotProps">
                        <div class="flex items-center gap-4">
                            <span
                                class="text-nowrap"
                                v-if="slotProps.data.name === 'Super admin'"
                            >
                                {{ superAdminCount }}
                            </span>
                            <span
                                class="text-nowrap"
                                v-else-if="slotProps.data.name === 'Admin'"
                            >
                                {{ staffCount }}
                            </span>
                            <span
                                class="text-nowrap"
                                v-else-if="slotProps.data.name === 'Member'"
                            >
                                {{ memberCount }}
                            </span>
                            <span v-else>0</span>
                        </div>
                    </template>
                </Column>
                <Column header="Actions">
                    <template #body="slotProps">
                        <ul class="action_lists">
                            <li class="action_item">
                                <Link
                                    as="button"
                                    class="!py-[10px] action_link"
                                    @click="
                                        () =>
                                            deleteActionHandler(
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
        </div>

        <Modal
            title="Create role"
            :modalVisible="page.props.modalCreate"
            @closeModal="closeModalHandler"
        >
            <RoleForm />
        </Modal>
    </UserManagementLayout>
</template>
