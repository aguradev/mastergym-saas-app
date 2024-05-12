<script setup>
import { Link } from '@inertiajs/vue3';
import { toRefs } from 'vue';
const props = defineProps({
    menuNav: Array,
    menuNavActivated: Object,
})

const { menuNav, menuNavActivated } = toRefs(props);

</script>

<template>
    <aside
        class="fixed top-0 z-[99] bg-primary-900 h-full left-0 flex flex-col border-r top-50 border-primary-600 min-w-72">
        <div class="p-12 text-2xl font-bold text-center text-nowrap">Master Gym</div>

        <nav class="flex flex-col flex-1 gap-y-8">
            <Link v-for="(menu, j) in menuNav[1]?.items" :key="j" :href="menu.link"
                class="flex items-center px-6 font-[500] text-base text-primary-400 hover:text-surface-400 transition text-nowrap"
                :class="{ 'text-surface-400 font-semibold': menuNavActivated === menu }">
            <i :class="menu.icon" class="mr-3"></i>
            <span>{{ menu.label }}</span>
            </Link>
        </nav>
    </aside>
</template>
