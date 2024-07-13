<script setup>
import Card from "@components/elements/card/DefaultCard.vue";
import { usePage } from "@inertiajs/vue3";
import Badge from "primevue/badge";
import Button from "primevue/button";
import { toRef } from "vue";

const page = usePage();
const props = page.props;

const tenantTransactionLatests = toRef(() => props.transactionLatest);
</script>

<template>
    <Card>
        <template #card__title>
            <div class="flex items-center justify-between mb-6">
                <h3>Latest Transactions</h3>
                <Button
                    :pt="{
                        root: 'bg-primary-900 px-4 text-base py-2 rounded-lg text-white hover:bg-primary-700',
                    }"
                >
                    <a href="#" class="font-bold">View all</a>
                </Button>
            </div>
        </template>

        <template #card__content>
            <div
                class="flex flex-col gap-y-6"
                v-if="tenantTransactionLatests.length > 0"
            >
                <figure
                    v-for="transaction in tenantTransactionLatests"
                    class="flex flex-col p-5 rounded-lg gap-y-6 bg-primary-900"
                    :key="transaction.id"
                >
                    <header class="flex flex-col gap-y-2">
                        <h6 class="text-base">
                            {{
                                transaction.plan_purchase
                                    .tenant_subscription_plan.name
                            }}
                        </h6>
                        <p class="text-sm text-white/50">
                            {{ transaction.full_name }}
                        </p>
                    </header>

                    <figcaption>
                        <Badge
                            :value="transaction.status"
                            :severity="
                                transaction.status === 'PAID'
                                    ? 'success'
                                    : transaction.status === 'PENDING'
                                      ? 'info'
                                      : 'danger'
                            "
                            class="w-[16%]"
                        />
                    </figcaption>
                </figure>
            </div>
            <div v-else>
                <h4>No transaction found</h4>
            </div>
        </template>
    </Card>
</template>
