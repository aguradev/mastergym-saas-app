<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed, toRef, toRefs } from 'vue'
import { parse } from 'vue/compiler-sfc';

const page = usePage();
const { hero } = toRefs(page.props)

const parsedHero = computed(() => {
    try {
        return JSON.parse(hero.value);
    } catch (e) {
        console.log('error parsing hero value', e);
    }
})

const icon = computed(() => {
    return new URL(`${parsedHero.value.image}`, import.meta.url).href
})

// tenant9c855257-f207-4264-a261-395318631d7f
// storage\tenant9c855257-f207-4264-a261-395318631d7f\app\website-image\SxVxIMQuYbd0F4et9IWFVmCiNpvOzRJkxQpO7Uv2.webp
</script>

<template>
    <div :style="{ 'background': 'url(' + icon + ')', 'background-size': 'cover', 'background-repeat': 'no-repeat' }">
        <div class="h-screen bg-opacity-50 bg-black flex items-center justify-center"
            style="background: rgba(0, 0, 0, 0.5)">
            <div class="mx-2 text-center">
                <h1 class="text-white font-bold text-4xl xs:text-5xl md:text-6xl"><span>{{ parsedHero.title }}</span>
                </h1>
                <div class="inline-flex">
                    <button
                        class="py-3 px-4  my-5 mx-2 bg-orange-500 border-orange-500 hover:bg-white hover:border-white hover:text-orange-500 hover:font-bold font-semibold text-white rounded-md border-[3px] shadow-md transition duration-500 md:text-xl capitalize">{{
                            parsedHero.btnLeft }}</button>
                    <a href="#about"><button
                            class="py-3 px-4 my-5 mx-2 bg-transparent border-[3px] hover:bg-orange-500 border-orange-500 rounded-md font-bold text-white shadow-md transition duration-500 md:text-lg capitalize">
                            {{ parsedHero.btnRight }}
                        </button></a>
                </div>
            </div>
        </div>
    </div>
</template>
