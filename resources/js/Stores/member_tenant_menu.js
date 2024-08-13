import { defineStore } from "pinia";
import { computed, reactive, ref } from "vue";

export const useNavMemberDashboard = defineStore("member_tenant_nav", () => {
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
                    icon: "pi pi-book",
                    label: "Subscription",
                    link: route("tenant-dashboard.overview-page"),
                },
                {
                    icon: "pi pi-user",
                    label: "Profile",
                    link: route("tenant-dashboard.profile"),
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
