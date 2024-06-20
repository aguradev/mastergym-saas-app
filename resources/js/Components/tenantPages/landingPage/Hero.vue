<script setup></script>

<style scoped>
    #up {
        background: url('https://www.energy.fit/cdn/shop/articles/cardio.jpg?v=1639065893&width=2048');
        background-size: cover;
        background-repeat: no-repeat;
    }
</style>

<template>
    <div id="up">
        <!-- Overlay Background + Center Control -->
        <div
            class="h-screen bg-opacity-50 bg-black flex items-center justify-center"
            style="background: rgba(0, 0, 0, 0.5)"
        >
            <div class="mx-2 text-center">
                <h1 class="text-gray-100 font-extrabold text-4xl xs:text-5xl md:text-6xl"><span class="text-white">Get In Shape With Our Service!</span></h1>
                <div class="inline-flex">
                    <button class="p-2 my-5 mx-2 bg-transparent border-orange-500 hover:bg-orange-500 font-semibold text-white rounded border-[3px] shadow-md transition duration-500 md:text-xl">Get Started!</button>
                    <a href="#about"
                        ><button
                            class="p-2 my-5 mx-2 bg-transparent border-[3px] hover:bg-opacity-100 border-orange-500 rounded font-bold text-white shadow-md transition duration-500 md:text-lg"
                        >
                            Learn More -> 
                        </button></a
                    >
                </div>
            </div>
        </div>
    </div>
</template>
