<script setup>
import { onMounted, reactive, ref } from 'vue'
import SubscriptionsLayout from '@layouts/SubscriptionsLayout.vue';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ActionLists from '@components/elements/ulLists/ActionLists.vue';
import PrimaryButton from '@components/elements/button/PrimaryButton.vue';
import Modal from '@components/ui/modal/Index.vue';
import CreateForm from '@pages/dashboard/central_page/subscription_page/tenant_plan_page/CreateForm.vue';

const dataSubscriptions = ref([
    {
        id: 1,
        plan: "Silver plan",
        features: [
            "100 Member",
            "5 Plan subscription"
        ],
        price: 50000,
        typePlan: "Monthly"
    },
    {
        id: 2,
        plan: "Gold plan",
        features: [
            "100 Member",
            "5 Plan subscription",
            "PT Management"
        ],
        price: 1500000,
        typePlan: "Monthly"
    },
    {
        id: 3,
        plan: "Platinum plan",
        features: [
            "100 Member",
            "5 Plan subscription",
            "PT Management",
            "Open Class Mentoring"
        ],
        price: 2000000,
        typePlan: "Yearly"
    },
    {
        id: 4,
        plan: "Ultimate plan",
        features: [
            "500 Member",
            "5 Plan subscription",
            "PT Management",
            "Open Class Mentoring",
            "Gym Stuff Management"
        ],
        price: 5000000,
        typePlan: "Yearly"
    },
])

const createModalVisible = ref(false)

const formatCurrency = (price) => {
    return price.toLocaleString('id-ID', { style: "currency", currency: "IDR" })
}

</script>

<template>
    <SubscriptionsLayout>
        <section class="p-8">
            <PrimaryButton icon="pi pi-plus" label="Add Plan Subscription"
                @click-event="() => createModalVisible = true" />
        </section>

        <section class="table_subscriptions">

            <DataTable :value="dataSubscriptions" :pt="{
                bodyrow: 'bg-transparent last:border-none border-b border-primary-700 odd:bg-primary-800',
                column: {
                    headercell: 'py-6 px-12 border-b border-primary-600',
                    headercontent: 'text-left font-[300] tracking-wide text-white/50',
                    bodycell: 'px-12 py-6 text-base',
                }
            }">
                <Column header="No">
                    <template #body="slotProps">
                        <div>{{ slotProps.data.id }}</div>
                    </template>
                </Column>
                <Column header="Plans">
                    <template #body="slotProps">
                        <div>{{ slotProps.data.plan }}</div>
                    </template>
                </Column>
                <Column header="Prices">
                    <template #body="slotProps">
                        <div>{{ formatCurrency(slotProps.data.price) }}</div>
                    </template>
                </Column>
                <Column header="Features">
                    <template #body="slotProps">
                        <ul>
                            <li v-for="item in slotProps.data.features" class="mb-3">{{ item }}</li>
                        </ul>
                    </template>
                </Column>
                <Column header="Types">
                    <template #body="slotProps">
                        <Badge :value="slotProps.data.typePlan"
                            :severity="slotProps.data.typePlan === 'Monthly' ? `success` : `info`">
                        </Badge>
                    </template>
                </Column>
                <Column header="Actions">
                    <template #body="slotProps">
                        <ActionLists />
                    </template>
                </Column>
            </DataTable>

        </section>

    </SubscriptionsLayout>

    <Modal title="Create tenant subscription plan" :modal-visible="createModalVisible"
        @close-modal="() => createModalVisible = false">
        <CreateForm />
    </Modal>
</template>
