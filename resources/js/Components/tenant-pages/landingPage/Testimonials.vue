<script setup>

import { computed, ref, toRefs } from 'vue';
import TestimonialsCard from './TestimonialsCard.vue';
import { usePage } from '@inertiajs/vue3';

const page = usePage();
const { testimony } = toRefs(page.props);

const parsedTestimony = computed(() => {
    try {
        return JSON.parse(testimony.value);
    } catch (e) {
        console.log('error parsing testimony value', e)
    }
})
</script>

<template>
    <section id="#testimony" class="bg-slate-500">
        <div class="mx-auto max-w-screen-2xl px-4 py-12 sm:px-6 lg:px-40 lg:py-16">
            <div class="md:flex md:items-end md:justify-between">
                <div class="max-w-xl">
                    <h2 class="text-4xl font-bold tracking-tight text-orange-400 sm:text-5xl capitalize">
                        {{ parsedTestimony.title }}
                    </h2>

                    <p class="mt-6 max-w-lg leading-relaxed text-white">
                        {{ parsedTestimony.text }}
                    </p>
                </div>

                <a href="#"
                    class="mt-6 inline-flex shrink-0 items-center gap-2 rounded-lg border-orange-400 px-5 py-3 text-white transition hover:bg-orange-400 border-[3px] hover:text-white md:mt-0">
                    <span class="font-semibold capitalize">{{ parsedTestimony.button }}</span>
                </a>
            </div>

            <div class="mt-8 grid grid-cols-1 gap-4 md:grid-cols-3">
                <TestimonialsCard v-for="(card, index) in parsedTestimony.cards" :key="index" :stars="card.stars"
                    :title="card.title" :text="card.text" :name="card.name" />
            </div>
        </div>
    </section>
</template>