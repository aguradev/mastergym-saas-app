<script setup>
import PrimaryButton from "@components/elements/button/PrimaryButton.vue";
import ValidationMessage from "@components/ui/cta/ValidationMessage.vue";
import { router, useForm, usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import { route } from "ziggy-js";

const formRequestPermissions = useForm({
    permissions: [],
});

const page = usePage();
const permissionLists = computed(() => page.props.permissionLists);
const rolesDetail = computed(() => page.props.rolesDetail);

const setPermissions = (e) => {
    formRequestPermissions.permissions = [
        ...formRequestPermissions.permissions,
        e.target.value,
    ];
};

const handleSubmit = () => {
    formRequestPermissions.post(
        route("tenant-dashboard.user-management.assign-permission", {
            id: rolesDetail.value?.id,
        }),
        {
            only: ["flash", "errors"],
        },
    );
};
</script>

<template>
    <form autocomplete="off" @submit.prevent="handleSubmit">
        <div
            class="flex gap-4 items-center mb-4 last:mb-0"
            v-for="(permission, i) in permissionLists"
            key="permission.id"
        >
            <input
                type="checkbox"
                name="permission_lists[]"
                :id="`permission_${permission.name}`"
                class="size-4 appearance-none bg-primary-600 rounded-sm border border-surface-400 checked:bg-surface-500"
                :value="permission.name"
                @input="setPermissions"
            />
            <label :for="`permission_${permission.name}`">{{
                permission.name
            }}</label>
        </div>
        <ValidationMessage
            v-if="formRequestPermissions.errors.permissions"
            :caption="formRequestPermissions.errors.permissions"
        />

        <PrimaryButton type="submit" label="submit" class="!px-6 !py-3 !mt-8" />
    </form>
</template>
