<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";

import PricingCard from "@components/ui/pricing-card/IndexTenant.vue"

const isToggle = ref(false);
const link = "/signup";

const fetchDataPricing = ref({
    title: "Choose Your Member Type!",
    text: "Here is lists of our membership prices depending on what you need, either monthly or yearly",
    cards: [
        { id: 1, title: 'Basic', price: 250000, features: [{ id: 1, name: "feat1" }, { id: 2, name: "feat2" }, { id: 3, name: "feat3" }, { id: 4, name: "feat4" }, { id: 5, name: "feat5" }, { id: 6, name: "feat6" }], period: "month" },
        { id: 2, title: 'Ultimate', price: 550000, features: [{ id: 1, name: "feat1" }, { id: 2, name: "feat2" }, { id: 3, name: "feat3" }, { id: 4, name: "feat4" }, { id: 5, name: "feat5" }, { id: 6, name: "feat6" }], period: "month" },
        { id: 2, title: 'Premium', price: 350000, features: [{ id: 1, name: "feat1" }, { id: 2, name: "feat2" }, { id: 3, name: "feat3" }, { id: 4, name: "feat4" }, { id: 5, name: "feat5" }, { id: 6, name: "feat6" }], period: "month" },
        { id: 2, title: 'Basic', price: 2500000, features: [{ id: 1, name: "feat1" }, { id: 2, name: "feat2" }, { id: 3, name: "feat3" }, { id: 4, name: "feat4" }, { id: 5, name: "feat5" }, { id: 6, name: "feat6" }], period: "year" },
        { id: 2, title: 'Ultimate', price: 5500000, features: [{ id: 1, name: "feat1" }, { id: 2, name: "feat2" }, { id: 3, name: "feat3" }, { id: 4, name: "feat4" }, { id: 5, name: "feat5" }, { id: 6, name: "feat6" }], period: "year" },
        { id: 2, title: 'Premium', price: 3500000, features: [{ id: 1, name: "feat1" }, { id: 2, name: "feat2" }, { id: 3, name: "feat3" }, { id: 4, name: "feat4" }, { id: 5, name: "feat5" }, { id: 6, name: "feat6" }], period: "year" },
    ]
})

const togglePricing = () => {
    isToggle.value = !isToggle.value;
};
</script>

<template>
    <section class="py-10 bg-slate-700 sm:py-16 lg:py-24">
        <div id="pricing" class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto text-center">
                <h2 class="text-5xl font-bold leading-tight text-orange-400 sm:text-2xl lg:text-5xl">
                    {{ fetchDataPricing.title }}
                </h2>
                <p class="max-w-md mx-auto mt-4 text-base leading-relaxed text-white">
                    {{ fetchDataPricing.text}}
                </p>
            </div>

            <div class="mt-10">
                <div class="flex items-center justify-center space-x-2.5">
                    <span class="text-base font-medium text-white">
                        Monthly
                    </span>

                    <input type="checkbox" class="peer sr-only opacity-0" id="toggle" />
                    <label @click="togglePricing" for="toggle"
                        class="relative flex h-6 w-11 cursor-pointer items-center rounded-full bg-gray-400 px-0.5 outline-gray-400 transition-colors before:h-5 before:w-5 before:rounded-full before:bg-white before:shadow before:transition-transform before:duration-300 peer-checked:bg-orange-500 peer-checked:before:translate-x-full peer-focus-visible:outline peer-focus-visible:outline-offset-2 peer-focus-visible:outline-gray-400 ">
                        <span class="sr-only">Enable</span>
                    </label>

                    <span class="text-base font-medium text-white">
                        Yearly
                    </span>
                </div>
            </div>

            <div v-if="!isToggle" class="grid max-w-6xl grid-cols-1 gap-6 mx-auto sm:grid-cols-3 mt-14 md:gap-9">
                <div id="card" v-for="(card, index) in fetchDataPricing.cards">
                    <PricingCard v-if="card.period === 'month'" :title="card.title" :price="card.price"
                        :features="card.features" :period="card.period" />
                </div>
            </div>

            <div v-if="isToggle" class="grid max-w-6xl grid-cols-1 gap-6 mx-auto sm:grid-cols-3 mt-14 md:gap-9 mt-[20px]">
                <div id="card" v-for="(card, index) in fetchDataPricing.cards">
                    <PricingCard v-if="card.period === 'year'" :title="card.title" :price="card.price"
                        :features="card.features" :period="card.period" />
                </div>
            </div>
        </div>
    </section>
</template>
