<script setup>
    import Card from 'primevue/card';

    const cards = [
        { title: 'Subscription', content: 'we provide prices that is suited for any level of services, ensuring that you will have many suitable options' },
        { title: 'Easy to Maintain', content: 'we provide prices that is suited for any level of services, ensuring that you will have many suitable options' },
        { title: 'Customisable', content: 'we provide prices that is suited for any level of services, ensuring that you will have many suitable options' },
        { title: 'Certified', content: 'we provide prices that is suited for any level of services, ensuring that you will have many suitable options' },
    ];
</script>

<template>
    <div class="bg-gray-50 text-black py-[50px] flex flex-col items-center">
        <h1 class="text-6xl px-10 font-bold text-gray-600">Features.</h1>
        <p>Lists of features and perks that our app offers for you!</p>
        <div
            id="dashboard"
            class="grid place-items-center w-[100%] mb-10 mt-20"
        >
            <img
                class="w-[300px] md:w-[60%] lg:w-[50%]"
                src="/public/storage/images/svg/undraw_data_trends_re_2cdy.svg"
                alt="Dashboard Image"
            />
        </div>
        <div
            id="features"
            class="md:flex justify-evenly gap-x-7 w-[80%] mt-5"
        >
            <div v-for="item in cards">
                <Card
                    :pt="{
                        title: {
                            class: '!text-center !text-gray-700 ',
                        },
                        content: {
                            class: '!text-gray-700',
                        },
                    }"
                    :ptOptions="{ mergeProps: true }"
                >
                    <template #title>{{ item.title }}</template>
                    <template #content>
                        <p class="text-center px-2">{{ item.content }}</p>
                    </template>
                </Card>
            </div>
        </div>
    </div>
</template>
