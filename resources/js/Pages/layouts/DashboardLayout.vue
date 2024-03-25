<script setup>
import Menu from 'primevue/menu';
import MenuDropdown from "@/elements/dropdownToggle/Index.vue";
import { useMenuUser } from '@/stores/menu_dropdown_user';
import { router } from '@inertiajs/vue3';

const storeMenuUser = useMenuUser();
const { menuItem } = storeMenuUser;

const logoutEvent = () => {
    router.visit(menuItem[0]?.items[0]?.link, {
        method: "post",
    })
}

const props = defineProps({
    titleNav: {
        type: String,
        default: ""
    },
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
    @apply p-12 bg-primary-900
}

.sub__menu__header {
    @apply mt-[2rem] mb-3 px-4 font-bold;
}

.active {
    @apply text-white;
}

.user__account {
    @apply flex gap-x-3 rounded-full items-center text-white/30 hover:text-white cursor-pointer;
}
</style>

<template>

    <div class="flex w-full min-h-screen">

        <Menu :model="props.menuItems" :pt="{
            root: 'bg-primary-800 w-72 border-none rounded-none',
            start: 'sticky top-0 left-0',
            submenuheader: 'mt-[2rem] mb-3 px-4 font-bold px-8 text-lg',
            content: 'dark:bg-transparent;',
            menu: 'sticky top-20 left-0 flex flex-col gap-y-3'
        }">
            <template #start>
                <header class="flex px-8 pt-10">
                    <span class="text-2xl font-bold text-white">GymMaster</span>
                </header>
            </template>

            <template #submenuheader="{ item }" class="mt-5">
                <span class="text-surface-500">{{ item.label }}</span>
            </template>

            <template #item="{ item, props }">
                <a v-ripple v-bind="props.action" :href="item.link"
                    class="flex items-center px-8 text-base gap-x-5 hover:text-white dark:text-white/35"
                    :class="{ 'active': item.is_active }">
                    <i :class="`${item.icon} `"></i>
                    <span :class="{ 'font-[500]': item.is_active }" class="font-[300] tracking-wide">{{
            item.label
        }}</span>
                </a>
            </template>
        </Menu>

        <main class="flex-1 main">
            <nav class="flex items-center justify-between">
                <div class="heading">
                    <h3 class="text-2xl font-bold">{{ props.titleNav }}</h3>
                </div>

                <MenuDropdown :dropdownLists="menuItem">
                    <template #button_content>
                        <div class="user__account">
                            <div class="overflow-hidden rounded-full w-9 h-9">
                                <img src="https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg"
                                    class="object-cover w-full h-full" alt="image">
                            </div>
                            <span class="text-base">Admin</span>
                        </div>
                    </template>

                    <template #item_template>
                        <button type="button" @click="logoutEvent">Logout</button>
                    </template>
                </MenuDropdown>
            </nav>

            <div class="mt-8">
                <slot name="main_content" />
            </div>
        </main>
    </div>
</template>
