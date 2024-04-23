<script setup>
import { Link, usePage } from '@inertiajs/vue3';
const page = usePage();

const props = defineProps({
    'tabUrl': Array
})

const { tabUrl } = props;
const checkCurrentRoute = window.location.href

</script>

<style scoped>
.tab_nav {
    @apply overflow-hidden;

    .nav_lists {
        @apply flex w-full border-primary-600 border-b-2 relative;

        .nav_item_tab {
            @apply border-b-2 border-transparent pb-5 px-5 z-[2];

            &:hover .nav_link {
                @apply text-white;
            }

            &:hover,
            &.active {
                @apply border-surface-400;
            }
        }

        .nav_link {
            @apply text-base text-primary-300 block border-surface-400;

            &.active {
                @apply text-white
            }
        }
    }
}
</style>

<template>
    <nav class="tab_nav">
        <ul class="nav_lists">
            <li v-for="(tab, i) in tabUrl" :key="i" class="nav_item_tab"
                :class="{ 'active': checkCurrentRoute == tab.url }">
                <Link :href="tab.url" class="nav_link" :class="{ 'active': checkCurrentRoute == tab.url }">{{ tab.title
                }}</Link>
            </li>
        </ul>
    </nav>
</template>
