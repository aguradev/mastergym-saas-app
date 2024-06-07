<script setup>
    import { ref } from 'vue';
    import { Head } from '@inertiajs/vue3';
    import MainNavLayout from '@layouts/LandingPageLayout.vue';
</script>

<style scoped></style>

<template>
    <MainNavLayout>
        <Head title="Gym Master - About Us" />
    </MainNavLayout>
    <div
        id="about"
        class="bg-white min-h-screen text-black pt-[100px] py-20"
    >
        <div
            id="firstSplit"
            class="md:flex min-h-content bg-white"
        >
            <div
                id="left"
                class="md:w-1/2 p-10"
            >
                <h1 class="text-xl md:text-7xl font-semibold text-slate-800 text-right pt-20 relative">Who Are We?</h1>
                <p class="text-md md:text-xl text-justify pt-10 pl-5 md:pl-40">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam autem modi, eaque dolorum, beatae aliquid natus debitis doloribus adipisci rem error. Dolorum, accusantium! Necessitatibus nisi doloribus fugit
                    sapiente, placeat ex.
                </p>
            </div>
            <div
                id="right"
                class="md:w-1/2 flex items-center justify-left p-10 pt-0 pb-20"
            >
                <div class="flex h-[500px] rounded-full bg-gradient-to-b from-slate-300 to-slate-500">
                    <img
                        class="h-[400px]"
                        src="/public/storage/images/svg/undraw_people_re_8spw.svg"
                        alt=""
                    />
                </div>
            </div>
        </div>
        <!-- second split ====================================================================== -->
        <div
            id="secondSplit"
            class="md:flex min-h-content bg-white"
        >
            <div
                id="left"
                class="md:w-1/2 flex justify-end pr-10"
            >
                <div class="flex h-[500px] rounded-full bg-gradient-to-b from-slate-300 to-slate-500">
                    <img
                        class="h-[400px]"
                        src="/public/storage/images/svg/undraw_people_re_8spw.svg"
                        alt=""
                    />
                </div>
            </div>
            <div
                id="right"
                class="md:w-1/2 p-10"
            >
                <h1 class="text-xl md:text-7xl font-semibold text-slate-800 text-left pt-20 relative">What do we do?</h1>
                <p class="text-md md:text-xl text-justify pt-10 pr-40">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam autem modi, eaque dolorum, beatae aliquid natus debitis doloribus adipisci rem error. Dolorum, accusantium! Necessitatibus nisi doloribus fugit
                    sapiente, placeat ex.
                </p>
            </div>
        </div>
    </div>
</template>
