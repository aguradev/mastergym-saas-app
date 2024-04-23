<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps([
    "links"
])
const { links } = props
const replaceLinks = computed(() => {
    return links.map((item) => {
        const newLinks = { ...item }
        newLinks.label = newLinks.label.replace(/&laquo; Previous/g, "pi pi-angle-double-left").replace(/Next &raquo;/g, "pi pi-angle-double-right");
        return newLinks;
    })
})

</script>

<style scoped>
.pagination {
    @apply relative mt-10;

    .pagination_lists {
        @apply flex gap-x-5 justify-center items-center rounded-md;

        .pagination_link {
            @apply text-lg w-12 h-12 bg-transparent flex items-center justify-center rounded-full;

            &.active {
                @apply bg-primary-600;
            }
        }
    }
}
</style>

<template>
    <nav class="pagination">
        <ul class="pagination_lists">
            <li v-for="(link, index) in replaceLinks" class="pagination_item" :key="index">
                <Link v-if="link.url !== null" :href="link.url"
                    :class="`pagination_link ${link.active ? `active` : ''}`" replace>
                <span v-if="parseInt(link.label)">{{ link.label }}</span>
                <i v-else :class="link.label"></i>
                </Link>
            </li>
        </ul>
    </nav>
</template>
