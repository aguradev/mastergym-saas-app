import { defineStore } from "pinia";
import { ref } from "vue";

export const usePlanMenus = defineStore("plan_menus", () => {
    const tabContents = ref([
        { title: "Overview", url: route("plan.overview") },
        { title: "Plans Table", url: route("plan_tenant.table") },
        {
            title: "Features Table",
            url: route("plan_feature.table"),
        },
    ]);

    return { tabContents };
});
