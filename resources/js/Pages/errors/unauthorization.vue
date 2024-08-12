<script setup>
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div class="w-screen h-screen place-content-center">
        <div class="text-center mb-8">
            <div
                class="size-32 mx-auto mb-14 bg-red-600 rounded-full text-6xl place-content-center"
            >
                <i class="pi pi-times"></i>
            </div>

            <h1 class="text-5xl font-semibold mb-8">Unauthorizataion</h1>
            <p class="text-lg">
                You don't have permissions to access this page.
            </p>
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
