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
                    label: "Plans",
                    link: route("plan_tenant.table"),
                },
                {
                    icon: "pi pi-building",
                    label: "Tenants",
                },
                {
                    icon: "pi pi-building",
                    label: "Subscriptions",
                },
                {
                    icon: "pi pi-money-bill",
                    label: "Transactions",
                    link: route("central-dashboard.transactions.lists"),
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
