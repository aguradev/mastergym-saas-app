<script setup>
import TabNav from "@components/elements/tabs/TabNav.vue";
import SubscriptionContent from "./tab_content/SubscriptionContent.vue";
import TenantContent from "./tab_content/TenantContent.vue";
import TransactionContent from "./tab_content/TransactionContent.vue";
import { ref } from "vue";

const subscriptionMenuData = ["Subscription", "Tenant", "Invoice"];
const subscriptionTabContents = [
    SubscriptionContent,
    TenantContent,
    TransactionContent,
];

const subscriptionMenuActive = ref(subscriptionMenuData[0]);
const subscriptionContentActive = ref(subscriptionTabContents[0]);

const switchTabHandler = (index) => {
    subscriptionMenuActive.value = subscriptionMenuData[index];
    subscriptionContentActive.value = subscriptionTabContents[index];
};
</script>

<template>
    <section>
        <TabNav
            :menu="subscriptionMenuData"
            :menuActive="subscriptionMenuActive"
            @switchTabEvent="switchTabHandler"
        >
            <component :is="subscriptionContentActive" />
        </TabNav>
    </section>
</template>
