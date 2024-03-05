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
    @apply p-7
}
</style>

<template>

    <div class="flex h-screen min-w-screen">

        <Menu :model="props.menuItems" class="h-full border-none rounded-none w-72"
            pt:submenuheader="mt-[2rem] mb-3 px-4 font-bold" pt:menuitem="px-4">
            <template #start>
                <header class="flex px-4 pt-4">
                    <span class="text-2xl font-bold text-white">SaaS App</span>
                </header>
            </template>

            <template #submenuheader="{ item }" class="mt-5">
                <span class="text-primary-500">{{ item.label }}</span>
            </template>

            <template #item="{ item, props }">
                <a v-ripple v-bind="props.action" :href="item.link" class="flex items-center text-sm gap-x-3">
                    <i :class="`${item.icon} `"></i>
                    <span class="font-medium">{{ item.label }}</span>
                </a>
            </template>
        </Menu>

        <main class="flex-1 main">
            <slot name="main_content" />
        </main>
    </div>
</template>
