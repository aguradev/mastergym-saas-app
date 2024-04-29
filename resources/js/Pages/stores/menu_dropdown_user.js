import { defineStore } from "pinia";
import { reactive } from "vue";

export const useMenuUser = defineStore("menu_user_central", () => {
    const menuItem = reactive([
        {
            label: "Options",
            items: [
                {
                    label: "Logout",
                    link: route("central-dashboard.logout"),
                },
            ],
        },
    ]);

    const setMenuItem = (item, pos) => {
        menuItem[pos].items = [...menuItem[pos].items, item];
    };

    const removeAllItem = (pos) => {
        menuItem[pos].items.splice(0, menuItem[pos].items.length);
    };

    return { menuItem, setMenuItem };
});
