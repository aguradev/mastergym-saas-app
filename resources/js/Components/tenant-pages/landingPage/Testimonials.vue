<script setup>

import { ref } from 'vue';
import TestimonialsCard from './TestimonialsCard.vue';

const fetchTestimonialsItems = ref({
    title: "read trusted reviews from our customers",
    text: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur praesentium natus sapiente commodi. Aliquid sunt tempore iste repellendus explicabo dignissimos placeat, autem harum dolore reprehenderit quis! Quo totam dignissimos earum.",
    button: "read all reviews ->",
    cards: [
        {
            stars: 5,
            title: "stayin' alive",
            text: "As a regular gym-goer, I've found this gym to be the perfect place to stay motivated and fit. The wide range of equipment means I never get bored with my workouts, and the staff are always on hand to offer tips and support. The classes are diverse and cater to all fitness levels, making it easy to find something that suits my mood and goals. ",
            name: "john weak"
        },
        { stars: 3, title: "the facility is great!", text: "The gym is an incredible place to push your limits and achieve your fitness goals. The state-of-the-art equipment, variety of classes, and knowledgeable trainers create an environment that is both challenging and supportive. From the moment you walk in, you're greeted with a clean, motivating space filled with like-minded individuals.", name: "gavid doggins" },
        { stars: 4, title: "the best experience!", text: "I've been a member of this gym for over a year, and it continues to exceed my expectations. The facilities are top-notch, with clean and well-maintained equipment. The trainers are friendly and incredibly knowledgeable, always willing to help with form or suggest new routines. ", name: "ben dover" },
    ]
})
</script>

<template>
    <section id="#testimony" class="bg-slate-500">
        <div class="mx-auto max-w-screen-2xl px-4 py-12 sm:px-6 lg:px-40 lg:py-16">
            <div class="md:flex md:items-end md:justify-between">
                <div class="max-w-xl">
                    <h2 class="text-4xl font-bold tracking-tight text-orange-400 sm:text-5xl capitalize">
                        {{ fetchTestimonialsItems.title }}
                    </h2>

                    <p class="mt-6 max-w-lg leading-relaxed text-white">
                        {{ fetchTestimonialsItems.text }}
                    </p>
                </div>

                <a href="#"
                    class="mt-6 inline-flex shrink-0 items-center gap-2 rounded-lg border-orange-400 px-5 py-3 text-white transition hover:bg-orange-400 border-[3px] hover:text-white md:mt-0">
                    <span class="font-semibold capitalize">{{ fetchTestimonialsItems.button }}</span>
                </a>
            </div>

            <div class="mt-8 grid grid-cols-1 gap-4 md:grid-cols-3">
                <TestimonialsCard v-for="(card, index) in fetchTestimonialsItems.cards" :key="index" :stars="card.stars"
                    :title="card.title" :text="card.text" :name="card.name" />
            </div>
        </div>
    </section>
</template>