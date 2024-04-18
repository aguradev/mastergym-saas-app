<script setup>
import 'primeicons/primeicons.css'

const props = defineProps({
    links: {
        type: Array
    }
})
</script>

<style scoped>
.action_lists {
    @apply flex gap-x-6;

    .action_link {
        @apply text-base bg-primary-700 p-3 rounded;

        &:hover {
            @apply bg-primary-600;
        }
    }
}
</style>

<template>
    <ul class="action_lists">
        <li class="action_item">
            <a href="#" class="action_link">
                <i class="pi pi-eye"></i>
            </a>
        </li>
        <li class="action_item">
            <a href="#" class="action_link">
                <i class="pi pi-pencil"></i>
            </a>
        </li>
        <li class="action_item">
            <a href="#" class="action_link">
                <i class="pi pi-trash"></i>
            </a>
        </li>
    </ul>
</template>
