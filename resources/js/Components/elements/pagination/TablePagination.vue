<script setup>
import { computed, toRef } from "vue";

const props = defineProps({
    pagination: "object"
})

const emits = defineEmits(["loadPage"])

const paginationRef = toRef(props, 'pagination');

const linkPageNumbers = computed(() => {
    return paginationRef.value.links.filter((item) => parseInt(item.label));
})
</script>

<style scoped>
.pagination {
    @apply relative flex gap-x-12;

    .pagination_lists {
        @apply flex gap-x-5 justify-center items-center rounded-md;

        .pagination_link {
            @apply text-lg w-12 h-12 bg-primary-800 flex items-center justify-center rounded-full;

            &:hover,
            &.active {
                @apply bg-primary-600;
            }
        }

        .btn_arrow {
            @apply text-lg w-12 h-12 bg-transparent flex items-center justify-center rounded-full;
        }
    }
}
</style>

<template>
    <div class="flex items-center justify-center gap-x-14">

        <nav class="pagination">
            <ul class="pagination_lists">
                <li class="pagination_item" v-if="paginationRef.current_page > 1">
                    <button type="button" class="btn_arrow" @click="emits('loadPage', 1)">
                        <i class="pi pi-angle-double-left"></i>
                    </button>
                </li>
                <li class="pagination_item" v-if="paginationRef.current_page > 1">
                    <button type="button" class="btn_arrow" @click="emits('loadPage', paginationRef.current_page - 1)">
                        <i class="pi pi-angle-left"></i>
                    </button>
                </li>
            </ul>

            <ul class="pagination_lists">
                <li class="pagination_item" v-for="(link, index) in linkPageNumbers" :key="index">
                    <button type="button" class="pagination_link" :class="{ active: link.active }"
                        @click="emits('loadPage', parseInt(link.label))">{{ link.label
                        }}</button>
                </li>
            </ul>

            <ul class="pagination_lists">
                <li class="pagination_item" v-if="paginationRef.current_page < paginationRef.last_page">
                    <button type="button" class="btn_arrow" @click="emits('loadPage', paginationRef.current_page + 1)">
                        <i class="pi pi-angle-right"></i>
                    </button>
                </li>
                <li class="pagination_item" v-if="paginationRef.current_page < paginationRef.last_page">
                    <button type="button" class="btn_arrow" @click="emits('loadPage', paginationRef.last_page)">
                        <i class="pi pi-angle-double-right"></i>
                    </button>
                </li>
            </ul>
        </nav>
    </div>
</template>
