<script setup>
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import DynamicDetailContent from "@components/ui/dynamicDetailContent/Index.vue";
import Badge from "primevue/badge";

const page = usePage();
const membershipActive = computed(() => page.props.findTraineeActive);
const historyTransaction = computed(
    () => page.props.getHistoryTransactionTrainee,
);

console.log(membershipActive.value);
</script>

<template>
    <div class="grid lg:grid-cols-[2.5fr_1fr] gap-6">
        <section
            class="bg-primary-800 border border-surface-500 p-8 rounded-lg"
        >
            <header class="mb-8">
                <h1 class="text-2xl font-semibold mb-6">Membership Active</h1>
                <h4 class="text-lg font-semibold">
                    #{{ membershipActive.invoice_id }} Member
                </h4>
            </header>

            <div class="grid lg:grid-cols-2 items-start mb-8">
                <DynamicDetailContent
                    label="Membership"
                    classLabel="text-xl"
                    classCaption="text-lg"
                    :caption="membershipActive.membership_plan.title"
                />
                <DynamicDetailContent
                    label="Period type"
                    classLabel="text-xl"
                    classCaption="text-lg"
                    :caption="membershipActive.membership_plan.period_type"
                />
                <div>
                    <h4 :class="`mb-3 text-xl font-semibold capitalize`">
                        Features
                    </h4>
                    <ul
                        class="flex flex-col gap-2"
                        v-if="
                            membershipActive.membership_plan.membership_features
                                .length > 0
                        "
                    >
                        <li
                            v-for="feature in membershipActive.membership_plan
                                .membership_features"
                            class="text-lg"
                        >
                            {{ feature.title }}
                        </li>
                    </ul>
                    <span v-else>-</span>
                </div>
            </div>

            <div class="grid lg:grid-cols-2 mb-8">
                <DynamicDetailContent
                    label="Start date"
                    classLabel="text-xl"
                    classCaption="text-lg"
                    class="!mb-0"
                    :caption="membershipActive.start_date_format"
                />
                <DynamicDetailContent
                    label="Expired date"
                    classLabel="text-xl"
                    classCaption="text-lg"
                    class="!mb-0"
                    :caption="membershipActive.expired_date_format"
                />
            </div>

            <div>
                <h4 :class="`mb-3 text-xl font-semibold capitalize`">
                    Membership status
                </h4>
                <Badge
                    :severity="`${membershipActive.membership_status === 'INACTIVE' ? 'danger' : membershipActive.membership_status === 'ACTIVE' ? 'success' : 'info'}`"
                    :value="membershipActive.membership_status"
                    class="w-[10%]"
                />
            </div>
        </section>
        <section
            class="bg-primary-800 border border-surface-500 p-5 rounded-lg"
        >
            <header class="mb-8">
                <h1 class="text-lg font-semibold mb-6">History Transaction</h1>
                <div
                    v-for="content in historyTransaction"
                    class="bg-primary-900 p-4 rounded-lg mb-4"
                    :key="content.id"
                >
                    <header class="mb-4">
                        <h4 class="mb-2">
                            {{ content.membership_plan.title }}
                        </h4>
                        <p class="text-sm">
                            {{ content.created_at }}
                        </p>
                    </header>
                    <Badge
                        :severity="`${content.transaction_status === 'PAID' ? 'success' : content.transaction_status === 'PENDING' ? 'info' : 'danger'}`"
                        :value="content.transaction_status"
                        class="w-[20%]"
                    />
                </div>
            </header>
        </section>
    </div>
</template>
