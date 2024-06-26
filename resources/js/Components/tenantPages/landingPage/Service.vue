<script setup></script>

<style scoped>
.service-image {
    @apply h-[150px] mb-6 drop-shadow-2xl
}
</style>

<template>
    <div class="h-content flex-row justify-center bg-slate-500 text-white overflow-hidden pb-24">
        <div id="text" class="h-fit text-center pt-20">
            <p class="text-orange-400 text-5xl font-bold">What We Provide</p>
            <p class="text-white px-10 md:px-80 pt-5">Lists of services we provide that aims to enhance your fitness
                journey to
                the best of our abilities, we make sure to improve your experience using our service as much as
                possible!</p>
        </div>
        <div id="content" class="w-screen flex-row md:flex px-20 py-20 justify-evenly text-orange-500">
            <div id="box"
                class="bg-slate-200 drop-shadow-xl rounded-md w-[300px] h-[300px] flex flex-col font-bold justify-center items-center">
                <img src="/public/storage/images/icon/coach.png" class="service-image" alt="personal trainer">
                <p class="text-xl">Personal Trainer</p>
            </div>
            <div id="box"
                class="bg-slate-200 drop-shadow-xl rounded-md w-[300px] h-[300px] flex flex-col font-bold justify-center items-center">
                <img src="/public/storage/images/icon/barbell.png" class="service-image" alt="gym equipment">
                <p class="text-xl">Gym Equipment</p>
            </div>
            <div id="box"
                class="bg-slate-200 drop-shadow-xl rounded-md w-[300px] h-[300px] flex flex-col font-bold justify-center items-center">
                <img src="/public/storage/images/icon/member-card.png" class="service-image" alt="membership">
                <p class="text-xl">Membership</p>
            </div>
            <div id="box"
                class="bg-slate-200 drop-shadow-xl rounded-md w-[300px] h-[300px] flex flex-col font-bold justify-center items-center">
                <img src="/public/storage/images/icon/timetable.png" class="service-image" alt="gym class">
                <p class="text-xl">Gym Classes</p>
            </div>
        </div>
    </div>
</template>
