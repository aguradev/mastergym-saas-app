<script setup>
    import { Link, usePage } from '@inertiajs/vue3';
    import { computed, ref, toRefs } from 'vue';

    const page = usePage();
    const { cta } = toRefs(page.props);

    const parsedCTA = computed(() => {
        try {
            return JSON.parse(cta.value);
        } catch (e) {
            console.error('Error parsing cta JSON:', e);
            return null;
        }
    });

    let imgUrl = ref(parsedCTA.value.image);
</script>

<template>
    <div class="flex-column md:flex bg-slate-700 pt-10 md:py-20">
        <div
            id="left"
            class="h-content md:w-6/12 flex justify-center md:justify-end align-middle pl-20 pr-20"
        >
            <img
                :src="imgUrl"
                class="md:my-10 md:h-[400px] mr-10 mt-5 md:mr-0 md:mt-0 box-content rounded-md"
            />
        </div>
        <div
            id="right"
            class="h-content bg-slate-5 00 md:w-6/12 pl-10 pr-20 pb-10 md:pr-60 md:pb-0"
        >
            <p
                id="header"
                class="block text-orange-400 text-5xl font-semibold mt-10 md:mt-20 pb-5 capitalize"
            >
                {{ parsedCTA.header }}
            </p>
            <p
                id="content"
                class="block text-white text-md font-normal text-justify"
            >
                {{ parsedCTA.text }}
            </p>
            <Link
                href="/payment"
                class="inline-block justify-self-end bg-orange-400 mt-7 py-3 px-5 font-bold text-md tracking-wide rounded-md"
            >
                {{ parsedCTA.button }}
            </Link>
        </div>
    </div>
</template>
