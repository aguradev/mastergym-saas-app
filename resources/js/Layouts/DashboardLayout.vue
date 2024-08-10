<script setup>
import DropdownWrapper from "@components/ui/dropdown/dropdown-wrapper.vue";
import DashboardSidebar from "@components/ui/sidebar/DashboardSidebar.vue";
import { router, Head, usePage } from "@inertiajs/vue3";
import { provide, ref, toRefs } from "vue";
import { route } from "ziggy-js";

const page = usePage();

const dropdownUserContent = [
    {
        label: "Logout",
        url: route(page.props.logoutUrl ?? "central-dashboard.logout"),
        method: "post",
    },
];

const dropdownVisible = ref(false);

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
                label: "Options",
                items: [
                    {
                        label: "label 1",
                        link: "",
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
    <Head>
        <title>{{ metaHead.title }}</title>
    </Head>
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

                <div class="relative">
                    <div
                        class="user__account"
                        @click="() => (dropdownVisible = !dropdownVisible)"
                    >
                        <div class="overflow-hidden rounded-full w-9 h-9">
                            <img
                                :src="page.props?.userLogin?.user.profile_image"
                                class="object-cover w-full h-full"
                                alt="image"
                            />
                        </div>
                        <span class="text-base">{{
                            page.props?.userLogin?.username
                        }}</span>
                    </div>

                    <DropdownWrapper
                        :items="dropdownUserContent"
                        :visible="dropdownVisible"
                    />
                </div>
            </nav>

            <div>
                <slot />
            </div>
        </main>
    </div>
</template>
