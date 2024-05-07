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
        <h1 class="text-[50px] px-10 font-medium">We Provide Every Features That Your Gym Ever Need!</h1>
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
            class="md:flex justify-evenly gap-x-5 w-[80%] mt-5"
        >
            <div v-for="item in cards">
                <Card
                    :pt="{
                        title: {
                            class: '!text-center !text-black',
                        },
                        content: {
                            class: '!text-black',
                        },
                    }"
                    :ptOptions="{ mergeProps: true }"
                >
                    <template
                        #title
                        class="text-center"
                        >{{ item.title }}</template
                    >
                    <template #content>
                        <p class="text-center px-2">{{ item.content }}</p>
                    </template>
                </Card>
            </div>
        </div>
    </div>
</template>
