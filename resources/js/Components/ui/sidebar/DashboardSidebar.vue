<script setup>
import { Link } from '@inertiajs/vue3';
import { onMounted, onUnmounted, toRefs, ref, inject } from 'vue';
const props = defineProps({
    menuNav: Array,
    menuNavActivated: Object,
})

const { menuNav, menuNavActivated } = toRefs(props);
const sidebarRef = ref(true)
const mainSection = inject("mainSection")

function visibleSidebar(e) {

    if (window.innerWidth > 600) {
        sidebarRef.value = true
        mainSection.value.classList.replace("ml-0", "ml-72")
    } else {
        sidebarRef.value = false
        mainSection.value.classList.replace("ml-72", "ml-0")
    }
}

onMounted(() => {
    visibleSidebar();
    window.addEventListener("resize", visibleSidebar)
})

onUnmounted(() => {
    window.removeEventListener("resize", visibleSidebar)
})

</script>

<template>
    <Transition name="sidebar-slide">
        <aside
            class="fixed top-0 z-[99] bg-primary-900 h-full left-0 flex flex-col border-r top-50 border-primary-600 min-w-72"
            v-if="sidebarRef">
            <div class="p-12 text-2xl font-bold text-center text-nowrap">Master Gym</div>

            <nav class="flex flex-col flex-1 gap-y-8">
                <Link v-for="(menu, j) in menuNav[1]?.items" :key="j" :href="menu.link"
                    class="flex items-center px-8 font-[500] text-base text-primary-400 hover:text-surface-400 transition text-nowrap"
                    :class="{ 'text-surface-400 font-semibold': menuNavActivated === menu }">
                <i :class="menu.icon" class="mr-3"></i>
                <span>{{ menu.label }}</span>
                </Link>
            </nav>
        </aside>
    </Transition>
</template>


<style scoped>
.sidebar-slide-enter-active,
.sidebar-slide-leave-active {
    transition: all 500ms ease;
}

.sidebar-slide-enter-from,
.sidebar-slide-leave-to {
    transform: translateX(-300px);
}
</style>
