<script setup>
import { computed, ref, toRefs } from "vue";
import { usePage, router } from "@inertiajs/vue3";

import PricingCard from "@components/ui/pricing-card/IndexTenant.vue";
import FormatCurrency from "../../../Lib/Currency";
import { route } from "../../../../../vendor/tightenco/ziggy/src/js";

const isToggle = ref(false);

const page = usePage();
const { pricing } = toRefs(page.props);
const membershipPricings = computed(() => page.props.membershipPricings);

const parsedPricing = computed(() => {
    try {
        return JSON.parse(pricing.value);
    } catch (e) {
        console.error("Error parsing pricing JSON:", e);
        return null;
    }
});

const tabLists = ["Monthly", "Half Yearly", "Yearly"];
const tabActive = ref(tabLists[0]);

function visitRegister() {
    router.get(route("tenant.registration"));
}
</script>

<template>
    <section class="py-10 bg-slate-700 sm:py-16 lg:py-24">
        <div id="pricing" class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto text-center">
                <h2
                    class="text-5xl font-bold leading-tight text-orange-400 sm:text-2xl lg:text-5xl"
                >
                    {{ parsedPricing.title }}
                </h2>
                <p
                    class="max-w-md mx-auto mt-4 text-base leading-relaxed text-white"
                >
                    {{ parsedPricing.text }}
                </p>
            </div>

            <div class="mt-10">
                <div class="flex items-center justify-center space-x-2.5">
                    <div class="flex gap-x-4">
                        <button
                            v-for="(tab, i) in tabLists"
                            type="button"
                            :class="`px-7 py-4 rounded-lg text-xl ${tabActive === tab ? 'bg-slate-500' : ''}`"
                            :key="tab"
                            @click="() => (tabActive = tabLists[i])"
                        >
                            {{ tab }}
                        </button>
                    </div>
                </div>
            </div>

            <div
                v-if="tabActive == 'Monthly'"
                class="grid max-w-6xl grid-cols-1 gap-6 mx-auto sm:grid-cols-3 mt-14 md:gap-9"
            >
                <div
                    id="card"
                    v-for="(card, index) in membershipPricings['Monthly']"
                >
                    <PricingCard
                        v-if="card.period_type === 'Monthly'"
                        :title="card.title"
                        :price="FormatCurrency(card.amount)"
                        :features="card.membership_features"
                        :period="card.period_type"
                        @checkout-event="visitRegister"
                    />
                </div>
            </div>

            <div
                v-if="tabActive == 'Half Yearly'"
                class="grid max-w-6xl grid-cols-1 gap-6 mx-auto sm:grid-cols-3 mt-14 md:gap-9"
            >
                <div
                    id="card"
                    v-for="(card, index) in membershipPricings['Half Yearly']"
                >
                    <PricingCard
                        v-if="card.period_type === 'Half Yearly'"
                        :title="card.title"
                        :price="FormatCurrency(card.amount)"
                        :features="card.membership_features"
                        :period="card.period_type"
                        @checkout-event="visitRegister"
                    />
                </div>
            </div>

            <div
                v-if="tabActive == 'Yearly'"
                class="grid max-w-6xl grid-cols-1 gap-6 mx-auto sm:grid-cols-3 mt-14 md:gap-9 pb-[36px]"
            >
                <div
                    id="card"
                    v-for="(card, index) in membershipPricings['Yearly']"
                >
                    <PricingCard
                        v-if="card.period_type === 'Yearly'"
                        :title="card.title"
                        :price="FormatCurrency(card.amount)"
                        :features="card.membership_features"
                        :period="card.period_type"
                        @checkout-event="visitRegister"
                    />
                </div>
            </div>
        </div>
    </section>
</template>
