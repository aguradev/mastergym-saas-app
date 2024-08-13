<script setup>
import DashboardTenantLayout from "@layouts/DashboardTenantLayout.vue";
import InputGroup from "@components/ui/group/InputGroup.vue";
import InputText from "@components/elements/input/InputText.vue";
import ValidationMessage from "@components/ui/cta/ValidationMessage.vue";

import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const page = usePage();
const userProfile = computed(() => page.props.userLogin);
</script>

<template>
    <DashboardTenantLayout>
        <div class="px-6 py-4">
            <div class="size-48 rounded-full overflow-hidden mb-8">
                <img
                    :src="userProfile.user.profile_image"
                    class="overflow-hidden w-full h-full object-cover"
                />
            </div>

            <div class="grid lg:grid-cols-2 gap-4 max-w-[1200px]">
                <InputGroup label="Username" labelFor="username">
                    <InputText
                        input-type="text"
                        input-placeholder="Type username"
                        input-name="username"
                        input-id="username"
                    />
                    <ValidationMessage />
                </InputGroup>
                <InputGroup label="Email" labelFor="email">
                    <InputText
                        input-type="text"
                        input-placeholder="Type email"
                        input-name="email"
                        input-id="email"
                    />
                    <ValidationMessage />
                </InputGroup>
            </div>
        </div>
    </DashboardTenantLayout>
</template>
