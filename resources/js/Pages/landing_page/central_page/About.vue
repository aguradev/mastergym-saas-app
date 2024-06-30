<script setup>
import { ref } from "vue";
import { Head } from "@inertiajs/vue3";

import MainNavLayout from "@layouts/LandingPageLayout.vue";

import OurTeam from "@components/central-pages/landingPage/OurTeam.vue";
import Footer from "@components/central-pages/landingPage/Footer.vue";
</script>

<style scoped></style>

<template>
    <MainNavLayout>
        <Head title="Gym Master - About Us" />
    </MainNavLayout>
    <div
        id="about"
        class="bg-white min-h-screen text-black pt-[100px] py-1 sm:py-20 sm:px-40"
    >
        <div
            id="firstSplit"
            class="md:flex min-h-content bg-white pt-1 sm:pt-20"
        >
            <div id="left" class="md:w-1/2 p-10">
                <h1
                    class="text-2xl md:text-6xl font-semibold text-slate-700 text-right pt-1 sm:pt-20 relative"
                >
                    Who Are We?
                </h1>
                <p class="text-md md:text-xl text-justify pt-10 pl-5 md:pl-10">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Laboriosam autem modi, eaque dolorum, beatae aliquid natus
                    debitis doloribus adipisci rem error. Dolorum, accusantium!
                    Necessitatibus nisi doloribus fugit sapiente, placeat ex.
                </p>
            </div>
            <div
                id="right"
                class="md:w-1/2 flex items-center justify-left p-10 pt-0 pb-5 sm:*:pb-20"
            >
                <div
                    class="flex h-content sm:h-[500px] rounded-full bg-gradient-to-b from-slate-300 to-slate-500"
                >
                    <img
                        class="h-[300px] sm:h-[400px]"
                        src="/public/storage/images/svg/undraw_people_re_8spw.svg"
                        alt=""
                    />
                </div>
            </div>
        </div>
        <!-- second split ====================================================================== -->
        <div id="secondSplit" class="md:flex min-h-content bg-white pt-10">
            <div
                id="left"
                class="md:w-1/2 flex justify-end pr-10 pl-5 sm:pl-20"
            >
                <div
                    class="flex h-content sm:h-[500px] rounded-full bg-gradient-to-b from-slate-300 to-slate-500"
                >
                    <img
                        class="h-[300px] sm:h-[400px]"
                        src="/public/storage/images/svg/undraw_working_re_ddwy.svg"
                        alt=""
                    />
                </div>
            </div>
            <div id="right" class="md:w-1/2 p-10">
                <h1
                    class="text-2xl md:text-6xl font-semibold text-slate-700 text-left pt-1 sm:pt-20 relative"
                >
                    What do we do?
                </h1>
                <p class="text-md md:text-xl text-justify pt-10 pr-1 sm:pr-10">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Laboriosam autem modi, eaque dolorum, beatae aliquid natus
                    debitis doloribus adipisci rem error. Dolorum, accusantium!
                    Necessitatibus nisi doloribus fugit sapiente, placeat ex.
                </p>
            </div>
        </div>
    </div>
    <OurTeam />
    <Footer />
</template>
