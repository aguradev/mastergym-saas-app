<script setup>
import TrainessLayout from "./Index.vue";
import TrainessDetail from "./TrainessDetail.vue";
import TrainessEdit from "./TrainessEdit.vue";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import { usePage, Link, router } from "@inertiajs/vue3";
import { toRef } from "vue";
import { route } from "ziggy-js";
import Badge from "primevue/badge";
import Modal from "@components/ui/modal/Index.vue";

const page = usePage();
const userTrainess = toRef(() => page.props.userTrainess);
const modalTrainessDetail = toRef(() => page.props.modalTrainessDetail);
const modalTrainessEdit = toRef(() => page.props.modalTrainessEdit);
const closeModalHandler = () => {
    router.visit(route("tenant-dashboard.trainess"), {
        method: "get",
        replace: true,
    });
};

console.log(userTrainess.value);
</script>

<template>
    <TrainessLayout>
        <section v-if="userTrainess.data.length > 0">
            <DataTable
                :value="userTrainess.data"
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
                <Column header="User">
                    <template #body="slotProps">
                        <div class="flex items-center gap-x-4">
                            <img
                                :src="slotProps.data.user.profile_image"
                                class="rounded-full size-14"
                            />
                            <span>{{ slotProps.data.user.full_name }}</span>
                        </div>
                    </template>
                </Column>
                <Column header="Membership plan">
                    <template #body="slotProps">
                        <span>{{ slotProps.data.membership_plan.title }}</span>
                    </template>
                </Column>
                <Column header="Period type">
                    <template #body="slotProps">
                        <span>{{
                            slotProps.data.membership_plan.period_type
                        }}</span>
                    </template>
                </Column>
                <Column header="Expired date">
                    <template #body="slotProps">
                        <span>{{
                            slotProps.data.membership_expired_date ?? "-"
                        }}</span>
                    </template>
                </Column>
                <Column header="Membership status">
                    <template #body="slotProps">
                        <Badge
                            :value="slotProps.data.membership_status"
                            :severity="
                                slotProps.data.membership_status === 'ACTIVE'
                                    ? 'success'
                                    : 'danger'
                            "
                            class="w-[40%]"
                        />
                    </template>
                </Column>
                <Column header="Action">
                    <template #body="slotProps">
                        <ul class="action_lists">
                            <li class="action_item">
                                <Link
                                    as="button"
                                    class="action_link"
                                    :href="
                                        route('tenant-dashboard.trainess', {
                                            id: slotProps.data.id,
                                        })
                                    "
                                    :only="[
                                        'memberTrainessDetail',
                                        'modalTrainessDetail',
                                    ]"
                                    :preserve-state="true"
                                >
                                    <i class="pi pi-eye"></i>
                                </Link>
                            </li>
                            <li class="action_item">
                                <Link
                                    as="button"
                                    class="action_link"
                                    :href="
                                        route('tenant-dashboard.trainess', {
                                            id: slotProps.data.id,
                                        })
                                    "
                                    :only="[
                                        'memberTrainessDetail',
                                        'modalTrainessEdit',
                                    ]"
                                    :preserve-state="true"
                                >
                                    <i class="pi pi-pencil"></i>
                                </Link>
                            </li>
                        </ul>
                    </template>
                </Column>
            </DataTable>

            <Modal
                title="Trainess detail"
                :modal-visible="modalTrainessDetail"
                @close-modal="closeModalHandler"
                class-box="md:min-w-[1200px]"
            >
                <TrainessDetail />
            </Modal>

            <Modal
                title="Trainess Edit"
                :modal-visible="modalTrainessEdit"
                @close-modal="closeModalHandler"
            >
                <TrainessEdit />
            </Modal>
        </section>
    </TrainessLayout>
</template>
