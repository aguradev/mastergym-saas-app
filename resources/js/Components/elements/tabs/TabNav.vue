<script setup>
const props = defineProps({
    menu: Array,
    menuActive: String,
});

const emits = defineEmits(["switchTabEvent"]);
</script>

<template>
    <div class="relative">
        <nav
            class="flex items-center gap-x-12 w-full border-b border-primary-600 relative"
        >
            <div v-for="(nav, i) in props.menu">
                <button
                    type="button"
                    :class="`px-2 py-3 text-base ${menuActive === nav ? 'font-semibold border-b border-surface-600' : ''}`"
                    :key="nav"
                    @click="() => $emit('switchTabEvent', i)"
                >
                    {{ nav }}
                </button>
            </div>
        </nav>

        <div class="pt-6">
            <slot />
        </div>
    </div>
</template>
