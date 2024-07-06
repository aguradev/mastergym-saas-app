<script setup>
import { ref } from "vue"

import serviceCard from "./ServiceCard.vue"

const fetchServiceData = ref({
    title: "what we provide",
    text: "Lists of services we provide that aims to enhance your fitness journey to the best of our abilities, we make sure to improve your experience using our service as much as possible!",
    cards: [
        {id: 1, name: "personal trainer", image: '/public/assets/images/icon/coach.png'},
        {id: 2, name: "gym equipment", image: '/public/assets/images/icon/barbell.png'},
        {id: 3, name: "membership", image: '/public/assets/images/icon/member-card.png'},
        {id: 4, name: "gym classes", image: '/public/assets/images/icon/timetable.png'},
    ]
})

</script>

<template>
    <div class="h-content flex-row justify-center bg-slate-500 text-white overflow-hidden">
        <div id="text" class="h-fit text-center pt-20">
            <p class="text-orange-400 text-5xl font-bold capitalize">{{ fetchServiceData.title}}</p>
            <p class="text-white px-10 md:px-80 pt-5">{{ fetchServiceData.text}}</p>
        </div>
        <div id="content" class="w-screen grid grid-rows-1 sm:grid-cols-1 md:grid-cols-2 xl:grid-cols-4 px-20 py-20 text-orange-500">
            <serviceCard v-for="(item, index) in fetchServiceData.cards" :name="item.name" :image="item.image"/>
        </div>
    </div>
</template>
