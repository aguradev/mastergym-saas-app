<script setup>
    import DashboardMemberLayout from '@layouts/DashboardMemberLayout.vue';
    import { route } from 'ziggy-js';
    import { Link } from '@inertiajs/vue3';
    import DataTable from 'primevue/datatable';
    import Column from 'primevue/column';
    import { ref } from 'vue';

    const data = ref([
        {
            id: '1',
            name: 'trainer1',
            email: 'trainer1@gmail.com',
            phone: 13297389012,
            classes: ['cardio', 'strength'],
        },
        {
            id: '2',
            name: 'trainer2',
            email: 'trainer2@gmail.com',
            phone: 13297389012,
            classes: ['crossfit', 'powerlifting'],
        },
    ]);
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
    <DashboardMemberLayout titleNav="Personal Trainers">
        <div class="border-t-2 border-primary-600 mb-10" />
        <div class="px-20">
            <DataTable
                :value="data"
                :pt="{
                    bodyrow: 'bg-transparent last:border-none border-b border-primary-700 odd:bg-primary-800',
                    column: {
                        headercell: 'py-6 px-12 border-b border-primary-600',
                        headercontent: 'text-left font-[300] tracking-wide text-white/50',
                        bodycell: 'px-12 py-6 text-base',
                    },
                }"
            >
                <Column header="Full name">
                    <template #body="slotProps">
                        <div class="flex items-center gap-4">
                            <img
                                src=""
                                class="size-10 rounded-full object-cover"
                            />
                            <span class="text-nowrap">{{ slotProps.data.name }}</span>
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
                        <span class="text-nowrap">{{ slotProps.data.phone }}</span>
                    </template>
                </Column>
                <Column header="Classes">
                    <template #body="slotProps">
                        <div class="flex flex-wrap gap-2">
                            <span
                                v-for="c in slotProps.data.classes"
                                class="bg-surface-600 px-2 py-1 text-sm rounded-lg"
                                >{{ c }}</span
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
                                        route('tenant-dashboard.user-management.users', {
                                            id: slotProps.data.id,
                                        })
                                    "
                                    :only="['getUserDetail', 'modalUserEdit', 'rolesLists']"
                                    as="button"
                                    class="action_link"
                                >
                                    <i class="pi pi-eye"></i>
                                </Link>
                            </li>
                        </ul>
                    </template>
                </Column>
            </DataTable>
        </div>
    </DashboardMemberLayout>
</template>
