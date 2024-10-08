import { defineStore } from "pinia";
import { computed, reactive, ref } from "vue";

export const useNavTenantPlatform = defineStore("tenant_dashboard_nav", () => {
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
                    link: route("tenant-dashboard.overview-page"),
                },
                {
                    icon: "pi pi-users",
                    label: "Users",
                    link: route("tenant-dashboard.user-management.users"),
                },
                {
                    icon: "pi pi-money-bill",
                    label: "Membership",
                    link: route("tenant-dashboard.membership.plan-page"),
                },
                {
                    icon: "pi pi-users",
                    label: "Trainees",
                    link: route("tenant-dashboard.trainess"),
                },
                {
                    icon: "pi pi-window-maximize",
                    label: "Content Website",
                    link: route("website.hero"),
                },
                {
                    icon: "pi pi-cog",
                    label: "Setting",
                    link: route("tenant-dashboard.setting-page"),
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
