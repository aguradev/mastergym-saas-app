<script setup>
import Menu from 'primevue/menu';

const props = defineProps({
    metaHead: {
        type: Object,
        default: {
            title: "Dashboard"
        },
    },
    menuItems: {
        type: Array,
        default: [
            {
                "label": "Label here",
                "items": [
                    {
                        "label": "item 1"
                    },
                    {
                        "label": "item 2"
                    }
                ]
            }
        ]
    }
})

</script>

<style scoped>
.main {
    @apply p-12 rounded-l-[48px] bg-primary-800
}

.sub__menu__header {
    @apply mt-[2rem] mb-3 px-4 font-bold;
}

.active {
    @apply text-white;
}
</style>

<template>

    <div class="flex h-screen min-w-screen">

        <Menu :model="props.menuItems" class="h-full border-none rounded-none w-64 dark:bg-primary-900"
            pt:submenuheader="mt-[2rem] mb-3 px-4 font-bold px-8 text-lg"
            :pt="{ content: 'dark:bg-transparent;', menu: 'flex flex-col gap-y-3' }">
            <template #start>
                <header class="flex px-8 pt-10">
                    <span class="text-2xl font-bold text-white">SaaS App</span>
                </header>
            </template>

            <template #submenuheader="{ item }" class="mt-5">
                <span class="text-primary-200">{{ item.label }}</span>
            </template>

            <template #item="{ item, props }">
                <a v-ripple v-bind="props.action" :href="item.link"
                    class="flex items-center gap-x-5 dark:text-primary-300 hover:text-white px-8 text-base"
                    :class="{ 'active': item.is_active }">
                    <i :class="`${item.icon} `"></i>
                    <span class="font-medium tracking-wide">{{ item.label }}</span>
                </a>
            </template>
        </Menu>

        <main class="flex-1 main">
            <slot name="main_content" />
        </main>
    </div>
</template>
