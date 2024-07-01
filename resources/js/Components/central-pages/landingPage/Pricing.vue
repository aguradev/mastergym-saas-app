<script setup>
import { ref, toRefs } from "vue";
import PricingCard from "@components/ui/pricing-card/Index.vue";
import { usePage } from "@inertiajs/vue3";

const page = usePage();
const isToggle = ref(false);

const { pricing_lists } = toRefs(page.props);

const togglePricing = () => {
    isToggle.value = !isToggle.value;
};

const checkoutAction = (id) => {
    console.log(id);
};
</script>

<template>
    <section class="py-10 bg-gray-50 sm:py-16 lg:py-24">
        <div id="pricing" class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto text-center">
                <h2
                    class="text-5xl font-bold leading-tight text-gray-600 sm:text-4xl lg:text-6xl"
                >
                    Pricing & Plans
                </h2>
                <p
                    class="max-w-md mx-auto mt-4 text-base leading-relaxed text-gray-600"
                >
                    Here is lists of our pricing depending on what you need,
                    either monthly or yearly
                </p>
            </div>

            <div class="mt-10">
                <div class="flex items-center justify-center space-x-2.5">
                    <span class="text-base font-medium text-gray-900">
                        Monthly
                    </span>

                    <input
                        type="checkbox"
                        class="peer sr-only opacity-0"
                        id="toggle"
                    />
                    <label
                        @click="togglePricing"
                        for="toggle"
                        class="relative flex h-6 w-11 cursor-pointer items-center rounded-full bg-gray-400 px-0.5 outline-gray-400 transition-colors before:h-5 before:w-5 before:rounded-full before:bg-white before:shadow before:transition-transform before:duration-300 peer-checked:bg-violet-500 peer-checked:before:translate-x-full peer-focus-visible:outline peer-focus-visible:outline-offset-2 peer-focus-visible:outline-gray-400 peer-checked:peer-focus-visible:outline-violet-500"
                    >
                        <span class="sr-only">Enable</span>
                    </label>

                    <span class="text-base font-medium text-gray-900">
                        Yearly
                    </span>
                </div>
            </div>

            <div
                v-if="!isToggle"
                class="grid max-w-6xl grid-cols-1 gap-6 mx-auto sm:grid-cols-3 mt-14 md:gap-9"
            >
                <div v-for="(pricing, i) in pricing_lists" :key="pricing.id">
                    <PricingCard
                        :id="pricing.id"
                        :title="pricing.name"
                        :price="
                            pricing.tenant_version_latest.price_per_month_format
                        "
                        :features="pricing.tenant_version_latest.plan_features"
                        period="Month"
                        @checkout-event="checkoutAction"
                    />
                </div>
            </div>

            <div
                v-if="isToggle"
                class="grid max-w-6xl grid-cols-1 gap-6 mx-auto sm:grid-cols-3 mt-14 md:gap-9"
            >
                <div v-for="(pricing, i) in pricing_lists" :key="pricing.id">
                    <PricingCard
                        :id="pricing.id"
                        :title="pricing.name"
                        :price="
                            pricing.tenant_version_latest.price_per_year_format
                        "
                        :features="pricing.tenant_version_latest.plan_features"
                        period="Yearly"
                        @checkout-event="checkoutAction"
                    />
                </div>
            </div>
        </div>
    </section>
</template>
