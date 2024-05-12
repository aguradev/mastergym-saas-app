import { defineStore } from "pinia";
import { computed, reactive, ref } from "vue";

export const useNavMainPlatform = defineStore("dashboard_nav", () => {
    const navigationMenuItem = reactive([
        {
            separator: true,
        },
        {
            label: "Menus",
            items: [
                {
                    icon: "pi pi-chart-pie",
                    label: "Dashboard",
                    link: route("central-dashboard.main"),
                },
                {
                    icon: "pi pi-users",
                    label: "Subscriptions",
                    link: route("central-dashboard.subscriptions"),
                },
                {
                    icon: "pi pi-building",
                    label: "Tenants",
                },
                {
                    icon: "pi pi-users",
                    label: "User Management",
                },
                {
                    icon: "pi pi-money-bill",
                    label: "Transactions",
                },
                {
                    icon: "pi pi-cog",
                    label: "Setting",
                },
            ],
        },
        {
            separator: true,
        },
    ]);

    const menuItemActive = ref(navigationMenuItem[1]?.items[0]);

    const findNavigationMenuData = computed(() => {
        return navigationMenuItem.find((item) => {
            return item.label == "Menus";
        });
    });

    const isMenuItemActivated = (item) => {
        return item === menuItemActive.value;
    };

    return {
        navigationMenuItem,
        findNavigationMenuData,
        menuItemActive,
        isMenuItemActivated,
    };
});
