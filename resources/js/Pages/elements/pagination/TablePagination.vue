<script setup>
import { computed } from "vue";

const props = defineProps({
    pagination: "object"
})

const emits = defineEmits(["loadPage"])

const { pagination } = props;
const { total, current_page, last_page, links } = pagination;

const linkPageNumbers = computed(() => {
    return links.filter((item) => parseInt(item.label));
})
</script>

<style scoped>
.pagination {
    @apply relative;

    .pagination_lists {
        @apply flex gap-x-5 justify-center items-center rounded-md;

        .pagination_link {
            @apply text-lg w-12 h-12 bg-primary-800 flex items-center justify-center rounded-full;

            &:hover,
            &.active {
                @apply bg-primary-600;
            }
        }
    }
}
</style>

<template>
    <div class="flex items-center justify-center mt-10 gap-x-12">

        <div>{{ total }} items</div>

        <nav class="pagination">
            <ul class="pagination_lists">
                <li class="pagination_item" v-if="current_page > 1">
                    <button type="button" class="pagination_link" @click="emits('loadPage', 1)">
                        <i class="pi pi-angle-double-left"></i>
                    </button>
                </li>
                <li class="pagination_item" v-if="current_page > 1">
                    <button type="button" class="pagination_link" @click="emits('loadPage', current_page - 1)">
                        <i class="pi pi-angle-left"></i>
                    </button>
                </li>
                <li class="pagination_item" v-for="(link, index) in linkPageNumbers" :key="index">
                    <button type="button" class="pagination_link" :class="{ active: link.active }">{{ link.label
                        }}</button>
                </li>
                <li class="pagination_item" v-if="current_page < last_page">
                    <button type="button" class="pagination_link" @click="emits('loadPage', current_page + 1)">
                        <i class="pi pi-angle-right"></i>
                    </button>
                </li>
                <li class="pagination_item" v-if="current_page < last_page">
                    <button type="button" class="pagination_link" @click="emits('loadPage', last_page)">
                        <i class="pi pi-angle-double-right"></i>
                    </button>
                </li>
            </ul>
        </nav>
    </div>
</template>
