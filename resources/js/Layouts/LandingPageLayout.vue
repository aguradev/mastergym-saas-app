<script setup>
import { Link } from '@inertiajs/vue3';
import Button from 'primevue/button';
import GymIcon from '/public/assets/images/icon/gym.png';

import { ref } from 'vue';

const isOpen = ref(false);

const menus = [
    { name: 'HOME', link: '/' },
    { name: 'PRICING', link: '#pricing' },
    { name: 'CONTACT', link: '#footer' },
    { name: 'ABOUT', link: '/about' },
];

const showSidebar = ref(false);

const toggleSidebar = () => {
    showSidebar.value = !showSidebar.value;
};
</script>

<style>
html {
    scroll-behavior: smooth;
}
</style>

<template>
    <main>
        <header id="MainNav"
            class="fixed z-50 w-full flex items-center justify-between h-[70px] bg-gray-50 shadow-sm border-b">
            <div id="NavLeft" class="flex items-center justify-starts md:ml-20">
                <Link href="/" class="pl-3 min-w-[55px]">
                <img :src="GymIcon" alt="gym logo" class="w-[55px]" />
                </Link>
                <h1 class="mx-4 text-gray-600 font-medium text-xl">Gym Master</h1>
            </div>
            <div id="NavCenter" class="hidden lg:flex items-center ml-5 justify-center w-8/12 max-w-[600px]">
                <Link v-for="item in menus" :href="item.link"
                    class="flex items-center text-gray-600 font-semibold justify-center h-[60px] p-1 hover:bg-[#f2f2f2] w-full rounded-lg mx-1 cursor-pointer">
                {{ item.name }}</Link>
            </div>
            <div id="NavRight" class="hidden lg:flex w-2/12 mr-6 justify-center gap-2">
                <Link href="/signup"><Button :pt="{ root: '!bg-cyan-700 !border-transparent md:shrink-0' }"
                    :ptOptions="{ mergeProps: true }" label="SIGN-UP" severity="success" /></Link>
            </div>
            <div class="block sm:hidden self-end pb-3 pr-3">
                <Button @click="toggleSidebar" :pt="{ root: '!bg-cyan-700 !border-transparent !rounded-3xl' }"
                    :ptOptions="{ mergeProps: true }" type="button" icon="pi pi-ellipsis-v" />
            </div>
            <div v-show="showSidebar"
                class="absolute bg-gray-50 w-[100%] min-h-[40px] mt-[340px] pt-3 flex-column shadow-lg">
                <div id="Menu" class="inline-block w-full border-box h-[200px]">
                    <Link v-for="item in menus" :href="item.link"
                        class="flex items-center text-black justify-start h-[48px] p-1 pl-5 hover:bg-[#f2f2f2] w-full rounded-lg mx-1 cursor-pointer">
                    {{ item.name }}</Link>
                </div>
                <div id="NavRight" class="flex-row ml-5 h-[60px] justify-evenly">
                    <Link href="/signup" class="flex my-3"><Button :pt="{ root: '!bg-cyan-700 !border-transparent' }"
                        :ptOptions="{ mergeProps: true }" label="SIGN-UP" severity="success" /></Link>
                </div>
            </div>
        </header>
        <article>
            <slot />
        </article>
    </main>
</template>
