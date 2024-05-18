import { defineStore } from "pinia";
import { ref } from "vue";

export const useSubscriptionTabs = defineStore("subscription_tabs", () => {
    const tabContents = ref([
        { title: "Overview", url: route("central-dashboard.subscriptions") },
        { title: "Plans Table", url: route("plan_tenant.table") },
        {
            title: "Features Table",
            url: route("plan_feature.table"),
        },
    ]);

    return { tabContents };
});
