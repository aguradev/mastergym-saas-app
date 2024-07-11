import { defineStore } from 'pinia';
import { computed, reactive, ref } from 'vue';

export const useNavTenantPlatform = defineStore('tenant_dashboard_nav', () => {
    const navigationMenuItem = reactive([
        {
            separator: true,
        },
        {
            label: 'Menus',
            items: [
                {
                    icon: 'pi pi-chart-pie',
                    label: 'Dashboard',
                },
                {
                    icon: 'pi pi-users',
                    label: 'Member',
                },
                {
                    icon: 'pi pi-money-bill',
                    label: 'Membership',
                },
                {
                    icon: 'pi pi-money-bill',
                    label: 'Transactions',
                },
                {
                    icon: 'pi pi-window-maximize',
                    label: 'Content Website',
                    link: route('website.overview'),
                },
                {
                    icon: 'pi pi-cog',
                    label: 'Setting',
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
            return item.label == 'Menus';
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
