<script setup>
import { Link } from '@inertiajs/vue3'; 
</script>

<template>
    <div class="flex bg-slate-600 py-20">
        <div id="left" class="h-content bg-slate-600 w-6/12 flex justify-end align-middle pr-5">
            <img src="https://shorturl.at/fYk7V" class="py-10 h-[400px] box-content ">
        </div>
        <div id="right" class="h-content bg-slate-600 w-8/12 pl-10 px-40">
            <p id="header" class="block text-orange-400 text-5xl font-medium mt-20 pb-5">Become A Member Now!</p>
            <p id="content" class="block text-white text-xl font-medium text-justify">Unlock your full potential with
                our exclusive
                fitness
                programs at [Gym Name]. Join today and take the first step towards a healthier, stronger you! Our expert
                trainers, state-of-the-art facilities, and personalized workout plans are designed to help you achieve
                your fitness goals. Don’t wait—transform your life and become part of our vibrant community now! Sign up
                and start your journey with us.</p>
            <Link href="/payment"
                class="inline-block justify-self-end bg-orange-400 mt-7  py-3 px-5 font-bold tracking-wide rounded-md">
            JOIN US!
            </Link>
        </div>
    </div>
</template>