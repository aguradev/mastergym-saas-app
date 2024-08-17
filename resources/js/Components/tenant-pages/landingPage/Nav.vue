<script setup>
import { computed, ref, toRefs } from "vue";
import { Link, Head, usePage } from "@inertiajs/vue3";

// Navbar Toggle
document.addEventListener("DOMContentLoaded", function () {
    var $navbarBurgers = Array.prototype.slice.call(
        document.querySelectorAll(".navbar-burger"),
        0,
    );

    if ($navbarBurgers.length > 0) {
        $navbarBurgers.forEach(function ($el) {
            $el.addEventListener("click", function () {
                var $target = document.getElementById("main-nav");
                $target.classList.toggle("hidden");
            });
        });
    }
});

window.addEventListener("scroll", function () {
    const box = document.getElementById("box");
    if (window.scrollY > 200) {
        box.classList.add("bg-black");
    } else {
        box.classList.remove("bg-black");
    }
});

const navid = ref({
    item1: "#home",
    item2: "#service",
    item3: "#membership",
    item4: "#testimony",
    item5: "#about",
});

const page = usePage();
const { nav } = toRefs(page.props);

const parsedNav = computed(() => {
    try {
        return JSON.parse(nav.value);
    } catch (e) {
        console.log("error parsing nav data", e);
    }
});
</script>

<template>
    <Head :title="parsedNav.title" />
    <header id="box" class="z-10 fixed pb-2 bg-opacity-50 w-full duration-500">
        <div class="py-4 px-2 lg:mx-4 xl:mx-12">
            <div class="">
                <nav class="flex items-center justify-between flex-wrap">
                    <div class="block lg:hidden">
                        <button
                            class="navbar-burger flex items-center px-3 py-2 border rounded text-white border-white hover:text-white hover:border-white"
                        >
                            <svg
                                class="fill-current h-6 w-6 text-white"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"
                                />
                            </svg>
                        </button>
                    </div>
                    <div
                        id="main-nav"
                        class="w-full flex-grow lg:flex items-center lg:w-auto hidden"
                    >
                        <div
                            class="text-sm lg:flex-grow mt-2 animated jackinthebox xl:mx-8"
                        >
                            <Link
                                :href="navid.item1"
                                class="block lg:inline-block text-md font-bold text-orange-500 sm:hover:border-indigo-400 hover:text-orange-500 mx-2 focus:text-blue-500 p-1 hover:bg-gray-300 sm:hover:bg-transparent rounded-lg"
                            >
                                {{ parsedNav.menus[0] }}
                            </Link>
                            <Link
                                :href="navid.item2"
                                class="block lg:inline-block text-md font-bold text-white sm:hover:border-indigo-400 hover:text-orange-500 mx-2 focus:text-blue-500 p-1 hover:bg-gray-300 sm:hover:bg-transparent rounded-lg"
                            >
                                {{ parsedNav.menus[1] }}
                            </Link>
                            <Link
                                :href="navid.item3"
                                class="block lg:inline-block text-md font-bold text-white sm:hover:border-indigo-400 hover:text-orange-500 mx-2 focus:text-blue-500 p-1 hover:bg-gray-300 sm:hover:bg-transparent rounded-lg"
                            >
                                {{ parsedNav.menus[2] }}
                            </Link>
                            <Link
                                :href="navid.item4"
                                class="block lg:inline-block text-md font-bold text-white sm:hover:border-indigo-400 hover:text-orange-500 mx-2 focus:text-blue-500 p-1 hover:bg-gray-300 sm:hover:bg-transparent rounded-lg"
                            >
                                {{ parsedNav.menus[3] }}
                            </Link>
                            <Link
                                :href="navid.item5"
                                class="block lg:inline-block text-md font-bold text-white sm:hover:border-indigo-400 hover:text-orange-500 mx-2 focus:text-blue-500 p-1 hover:bg-gray-300 sm:hover:bg-transparent rounded-lg"
                            >
                                {{ parsedNav.menus[4] }}
                            </Link>
                        </div>
                        <div id="right-nav">
                            <Link href="/login">
                                <button
                                    class="py-2 px-4 bg-orange-500 border-orange-500 hover:bg-white hover:border-white hover:text-orange-500 hover:font-bold font-semibold text-white rounded-md border-[3px] shadow-md transition duration-500 capitalize"
                                >
                                    LOG IN
                                </button></Link
                            >
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>
</template>
