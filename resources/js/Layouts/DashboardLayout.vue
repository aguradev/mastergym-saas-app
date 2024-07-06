<script setup>
import Menu from "primevue/menu";
import MenuDropdown from "@components/elements/dropdownToggle/index.vue";
import DashboardSidebar from "@components/ui/sidebar/DashboardSidebar.vue";
import { useMenuUser } from "@stores/menu_dropdown_user";
import { router } from "@inertiajs/vue3";
import { onMounted, provide, ref, toRef, toRefs } from "vue";

const storeMenuUser = useMenuUser();
const { menuItem } = storeMenuUser;

const logoutEvent = () => {
    router.visit(menuItem[0]?.items[0]?.link, {
        method: "post",
    });
};

const props = defineProps({
    menuItemActive: {
        type: Object,
    },
    titleNav: {
        type: String,
        default: "",
    },
    metaHead: {
        type: Object,
        default: {
            title: "Dashboard",
        },
    },
    menuItems: {
        type: Array,
        default: [
            {
                label: "Label here",
                items: [
                    {
                        label: "item 1",
                    },
                    {
                        label: "item 2",
                    },
                ],
            },
        ],
    },
});
const mainSection = ref(null);
const { menuItems, menuItemActive } = toRefs(props);

provide("mainSection", mainSection);
</script>

<style scoped>
.main {
    @apply bg-primary-900;
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
        <DashboardSidebar
            :menuNav="menuItems"
            :menu-nav-activated="menuItemActive"
        />

        <main
            class="flex-1 transition-all duration-300 ease delay-[400] main ml-72"
            ref="mainSection"
        >
            <nav class="flex items-center justify-between p-8">
                <div class="heading">
                    <h3 class="text-2xl font-bold">{{ props.titleNav }}</h3>
                </div>

                <MenuDropdown :dropdownLists="menuItem">
                    <template #button_content>
                        <div class="user__account">
                            <div class="overflow-hidden rounded-full w-9 h-9">
                                <img
                                    src="https://t4.ftcdn.net/jpg/02/15/84/43/360_F_215844325_ttX9YiIIyeaR7Ne6EaLLjMAmy4GvPC69.jpg"
                                    class="object-cover w-full h-full"
                                    alt="image"
                                />
                            </div>
                            <span class="text-base">Admin</span>
                        </div>
                    </template>

                    <template #item_template>
                        <button type="button" @click="logoutEvent">
                            Logout
                        </button>
                    </template>
                </MenuDropdown>
            </nav>

            <div>
                <slot />
            </div>
        </main>
    </div>
</template>
