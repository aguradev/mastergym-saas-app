<script setup>
import { Link } from "@inertiajs/vue3";

const { status, title, message } = defineProps({
    status: String,
    title: String,
    message: String,
});
</script>

<template>
    <div class="w-screen h-screen place-content-center">
        <div class="text-center mb-8">
            <div
                v-if="status === 'success'"
                class="size-32 mx-auto mb-14 bg-surface-600 rounded-full text-6xl place-content-center"
            >
                <i class="pi pi-check"></i>
            </div>

            <h1 class="text-5xl font-semibold mb-8">{{ title }}</h1>
            <p>{{ message }}</p>
        </div>

        <div class="text-center">
            <Link
                as="button"
                href="/"
                class="text-center bg-surface-600 px-6 py-3 mx-auto rounded-lg"
                >Back to home
            </Link>
        </div>
    </div>
</template>
