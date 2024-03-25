import { defineStore } from "pinia";
import { computed, reactive } from "vue";

export const useNavMainPlatform = defineStore(
    "navigation_main_platform",
    () => {
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
                        is_active: false,
                    },
                    {
                        icon: "pi pi-users",
                        label: "Subscription",
                        link: route("central-dashboard.subscriptions"),
                        is_active: false,
                    },
                    {
                        icon: "pi pi-building",
                        label: "Vendor",
                        is_active: false,
                    },
                    {
                        icon: "pi pi-users",
                        label: "Users",
                        is_active: false,
                    },
                    {
                        icon: "pi pi-money-bill",
                        label: "Transactions",
                        is_active: false,
                    },
                    {
                        icon: "pi pi-cog",
                        label: "Setting",
                        is_active: false,
                    },
                ],
            },
            {
                separator: true,
            },
        ]);

        const findNavigationMenuData = computed(() => {
            return navigationMenuItem.find((item) => {
                return item.label == "Menus";
            });
        });

        const resetToFalseAllNavigation = computed(() => {
            return findNavigationMenuData.value.items.map(
                (item) => (item.is_active = false),
            );
        });

        const updateMenusItemActive = (route_url) => {
            const findPositionRouteName =
                findNavigationMenuData.value.items.find((item) => {
                    return item.link.includes(route_url);
                });

            resetToFalseAllNavigation;

            findPositionRouteName.is_active = true;
        };

        return {
            navigationMenuItem,
            findNavigationMenuData,
            updateMenusItemActive,
        };
    },
);
