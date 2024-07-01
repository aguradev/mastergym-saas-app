<script setup>
import { Link } from "@inertiajs/vue3";
import FeatLists from "@components/ui/pricing-card/FeatLists.vue";
import { toRefs } from "vue";
const props = defineProps({
    id: String,
    title: String,
    price: String,
    features: Array,
    period: String,
});

const { title, price, features } = toRefs(props);
const emits = defineEmits(["checkoutEvent"]);
</script>

<template>
    <div
        class="overflow-hidden basic-card border-2 rounded-md hover:scale-105 ease-in-out duration-300"
    >
        <div class="p-6 md:py-8 md:px-9">
            <h3 class="text-xl font-semibold basic-text text-zinc-900">
                {{ title }}
            </h3>

            <div class="flex items-end mt-5">
                <div class="flex items-start">
                    <span class="text-xl font-medium basic-text text-zinc-900">
                        Rp.
                    </span>
                    <p
                        class="text-3xl font-medium tracking-tight basic-price text-zinc-900"
                    >
                        {{ price }}
                    </p>
                </div>
                <span class="ml-0.5 text-lg basic-text text-zinc-900">
                    / {{ period }}
                </span>
            </div>

            <FeatLists :feature-lists="features" />

            <Link
                as="button"
                class="inline-flex items-center justify-center w-full px-4 py-3 mt-6 font-semibold bg-zinc-900 transition-all duration-200 bg-transparent border-2 rounded-full basic-button"
                @click="() => emits('checkoutEvent', id)"
            >
                Register Now
            </Link>
        </div>
    </div>
</template>
