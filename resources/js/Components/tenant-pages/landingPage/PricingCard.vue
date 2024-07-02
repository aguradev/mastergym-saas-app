<script setup>
</script>

<template>
    <!-- left banner  -->
    <div class="overflow-hidden basic-card border-2 rounded-md hover:scale-105 ease-in-out duration-300">
                    <div class="p-6 md:py-8 md:px-9">
                        <h3 class="text-xl font-semibold basic-text">Basic</h3>
                        <p class="mt-2.5 text-sm basic-text">All the basic features that you need to manage your gym.
                        </p>

                        <div class="flex items-end mt-5">
                            <div class="flex items-start">
                                <span class="text-xl font-medium basic-text"> Rp. </span>
                                <p class="text-6xl font-medium tracking-tight basic-price">99k</p>
                            </div>
                            <span class="ml-0.5 text-lg basic-text"> / month </span>
                        </div>

                        <Link :href="link">
                        <a
                            class="inline-flex items-center justify-center w-full px-4 py-3 mt-6 font-semibold text-gray-900 transition-all duration-200 bg-transparent border-2 rounded-full basic-button">
                            Try This Out!
                        </a>
                        </Link>

                        <ul class="flex flex-col mt-8 space-y-4">
                            <li class="inline-flex items-center space-x-2">
                                <svg class="flex-shrink-0 w-5 h-5 basic-icon" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-base font-medium basic-text"> 50 Maximum members</span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg class="flex-shrink-0 w-5 h-5 basic-icon" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-base font-medium basic-text"> 10 Daily Transactions</span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg class="flex-shrink-0 w-5 h-5 basic-icon" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-base font-medium basic-text"> Transaction Management </span>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg class="flex-shrink-0 w-5 h-5 basic-icon" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <strike class="text-base font-medium basic-text-dashed">Booking Personal
                                    Trainer</strike>
                            </li>

                            <li class="inline-flex items-center space-x-2">
                                <svg class="flex-shrink-0 w-5 h-5 basic-icon" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <strike class="text-base font-medium basic-text-dashed"> Advanced Support </strike>
                            </li>
                        </ul>
                    </div>
                </div>
</template>