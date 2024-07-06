<script setup>
import {ref} from 'vue';
import { Link, Head } from '@inertiajs/vue3';

// Navbar Toggle
document.addEventListener('DOMContentLoaded', function () {
    // Get all "navbar-burger" elements
    var $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

    // Check if there are any navbar burgers
    if ($navbarBurgers.length > 0) {
        // Add a click event on each of them
        $navbarBurgers.forEach(function ($el) {
            $el.addEventListener('click', function () {
                // Get the "main-nav" element
                var $target = document.getElementById('main-nav');

                // Toggle the class on "main-nav"
                $target.classList.toggle('hidden');
            });
        });
    }
});

window.addEventListener('scroll', function () {
    const box = document.getElementById('box');
    if (window.scrollY > 200) { // Adjust the scroll position as needed
        box.classList.add('bg-black'); // Change to the class you want to add
    } else {
        box.classList.remove('bg-black'); // Change to the class you want to remove
    }
});

</script>

<template>

    <Head title="XX Gym - Home" />
    <header id="box" class="z-10 fixed pb-2 bg-opacity-50 w-full duration-500">
        <div class="py-4 px-2 lg:mx-4 xl:mx-12">
            <div class="">
                <nav class="flex items-center justify-between flex-wrap">
                    <div class="block lg:hidden">
                        <button
                            class="navbar-burger flex items-center px-3 py-2 border rounded text-white border-white hover:text-white hover:border-white">
                            <svg class="fill-current h-6 w-6 text-white" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <title>Menu</title>
                                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                            </svg>
                        </button>
                    </div>
                    <div id="main-nav" class="w-full flex-grow lg:flex items-center lg:w-auto hidden">
                        <div class="text-sm lg:flex-grow mt-2 animated jackinthebox xl:mx-8">
                            <Link href="#home"
                                class="block lg:inline-block text-md font-bold text-orange-500 sm:hover:border-indigo-400 hover:text-orange-500 mx-2 focus:text-blue-500 p-1 hover:bg-gray-300 sm:hover:bg-transparent rounded-lg">
                            HOME
                            </Link>
                            <Link href="#service"
                                class="block lg:inline-block text-md font-bold text-white sm:hover:border-indigo-400 hover:text-orange-500 mx-2 focus:text-blue-500 p-1 hover:bg-gray-300 sm:hover:bg-transparent rounded-lg">
                            OUR SERVICE
                            </Link>
                            <Link href="#membership"
                                class="block lg:inline-block text-md font-bold text-white sm:hover:border-indigo-400 hover:text-orange-500 mx-2 focus:text-blue-500 p-1 hover:bg-gray-300 sm:hover:bg-transparent rounded-lg">
                            MEMBERSHIP
                            </Link>
                            <Link href="#testimony"
                                class="block lg:inline-block text-md font-bold text-white sm:hover:border-indigo-400 hover:text-orange-500 mx-2 focus:text-blue-500 p-1 hover:bg-gray-300 sm:hover:bg-transparent rounded-lg">
                            OUR REVIEWS
                            </Link>
                            <Link href="#about"
                                class="block lg:inline-block text-md font-bold text-white sm:hover:border-indigo-400 hover:text-orange-500 mx-2 focus:text-blue-500 p-1 hover:bg-gray-300 sm:hover:bg-transparent rounded-lg">
                            ABOUT US
                            </Link>
                        </div>
                        <div id="right-nav">
                            <Link href="">
                            </Link>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>
</template>
