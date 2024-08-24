<script setup>
import { usePage, Link, router } from "@inertiajs/vue3";
import { route } from "ziggy-js";
import UserManagementLayout from "@pages/dashboard/tenant_page/user_management/Index.vue";
import UserCredentialForm from "./UserCredentialForm.vue";
import Column from "primevue/column";
import DataTable from "primevue/datatable";

import { toRef, watch, watchEffect } from "vue";
import ModalSidebar from "@components/ui/sidebar/ModalSidebar.vue";

const page = usePage();
const modalUserCreate = toRef(() => page.props.modalUserCreate);
const modalUserEdit = toRef(() => page.props.modalUserEdit);
const usersData = toRef(() => page.props.usersData);

const closeModalHandler = () => {
    router.visit(route("tenant-dashboard.user-management.users"), {
        replace: true,
    });
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
                :href="route('tenant-dashboard.user-management.users')"
                preserve-state
                :only="['modalUserCreate', 'rolesLists']"
                as="button"
                class="bg-surface-600 px-4 py-3 rounded-lg flex items-center gap-x-2"
            >
                <i class="pi pi-plus"></i>
                <span>Create User</span>
            </Link>
        </header>
        <DataTable
            :value="usersData.data"
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
            <Column header="Full name">
                <template #body="slotProps">
                    <div class="flex items-center gap-4">
                        <img
                            :src="slotProps.data.profile_image"
                            class="size-10 rounded-full object-cover"
                        />
                        <span class="text-nowrap">{{
                            slotProps.data.full_name
                        }}</span>
                    </div>
                </template>
            </Column>
            <Column header="Email">
                <template #body="slotProps">
                    <span class="text-nowrap">{{ slotProps.data.email }}</span>
                </template>
            </Column>
            <Column header="Phone number">
                <template #body="slotProps">
                    <span class="text-nowrap">{{
                        slotProps.data.phone_number || "-"
                    }}</span>
                </template>
            </Column>
            <Column header="Assign Roles">
                <template #body="slotProps">
                    <div
                        v-for="role in slotProps.data.roles"
                        class="flex flex-wrap gap-2"
                    >
                        <span
                            class="bg-surface-600 px-2 py-1 text-sm rounded-lg"
                            >{{ role.name }}</span
                        >
                    </div>
                </template>
            </Column>
            <Column header="Actions">
                <template #body="slotProps">
                    <ul class="action_lists">
                        <li class="action_item">
                            <Link
                                :href="
                                    route(
                                        'tenant-dashboard.user-management.users',
                                        {
                                            id: slotProps.data.id,
                                        },
                                    )
                                "
                                :only="[
                                    'getUserDetail',
                                    'modalUserEdit',
                                    'rolesLists',
                                ]"
                                as="button"
                                class="action_link"
                            >
                                <i class="pi pi-pencil"></i>
                            </Link>
                        </li>
                    </ul>
                </template>
            </Column>
        </DataTable>
    </UserManagementLayout>

    <ModalSidebar
        :modal-visible="modalUserCreate"
        title="Create User"
        @close-modal="closeModalHandler"
    >
        <UserCredentialForm />
    </ModalSidebar>

    <ModalSidebar
        :modal-visible="modalUserEdit"
        title="Edit User"
        @close-modal="closeModalHandler"
    >
        <UserCredentialForm mode="edit" />
    </ModalSidebar>
</template>
