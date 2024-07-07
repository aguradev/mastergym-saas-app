<script setup>
import { Link } from "@inertiajs/vue3";
import FeatLists from "@components/ui/pricing-card/FeatListsTenant.vue";
import { toRefs } from "vue";
const props = defineProps({
    id: String,
    title: String,
    price: Number,
    features: Array,
    period: String,
});

const { title, price, features } = toRefs(props);
const emits = defineEmits(["checkoutEvent"]);
</script>

<template>
    <div
        class="bg-slate-600 overflow-hidden basic-card border-3 rounded-md hover:scale-105 ease-in-out duration-300 shadow-xl">
        <div class="p-6 md:py-8 md:px-9">
            <h3 class="text-2xl font-semibold basic-text text-white">
                {{ title }}
            </h3>

            <div class="flex items-end mt-5">
                <div class="flex items-start">
                    <span class="text-xl font-medium basic-text text-white">
                        Rp.
                    </span>
                    <p class="text-4xl font-medium tracking-tight basic-price text-orange-400">
                        {{ price }}
                    </p>
                </div>
                <span class="ml-0.5 text-lg basic-text text-white">
                    / {{ period }}
                </span>
            </div>

            <FeatLists :feature-lists="features" />

            <Link as="button" type="button"
                class="inline-flex items-center justify-center w-full px-4 py-3 mt-6 font-semibold bg-orange-500 transition-all duration-20 rounded-full basic-button"
                @click="() => emits('checkoutEvent', id)">
            Register Now
            </Link>
        </div>
    </div>
</template>
