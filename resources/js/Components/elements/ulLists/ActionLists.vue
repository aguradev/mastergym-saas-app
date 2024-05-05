<script setup>
import 'primeicons/primeicons.css'
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    editRoute: String,
    deleteRoute: String
})

const emits = defineEmits(["deleteEvent"])
</script>

<style scoped>
.action_lists {
    @apply flex gap-x-6 items-center;

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
            <Link href="#" class="action_link">
            <i class="pi pi-eye"></i>
            </Link>
        </li>
        <li class="action_item">
            <Link :href="editRoute" class="action_link" preserve-state>
            <i class="pi pi-pencil"></i>
            </Link>
        </li>
        <li class="action_item">
            <Link as="button" class="!py-[10px] action_link" @click="$emit('deleteEvent')">
            <i class="pi pi-trash"></i>
            </Link>
        </li>
    </ul>
</template>
