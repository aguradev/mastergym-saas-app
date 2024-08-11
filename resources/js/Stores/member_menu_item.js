import { defineStore } from 'pinia';
import { computed, reactive, ref } from 'vue';

export const useNavMemberPlatform = defineStore('member_dashboard_nav', () => {
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
                    // link: route('tenant-dashboard.overview-page'),
                },
                {
                    icon: 'pi pi-users',
                    label: 'Personal Trainer',
                    link: route('tenant.member.trainer'),
                },
                {
                    icon: 'pi pi-window-maximize',
                    label: 'Class',
                    link: route('tenant.member.class'),
                },
                {
                    icon: 'pi pi-cog',
                    label: 'Setting',
                    // link: route('website.overview'),
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
