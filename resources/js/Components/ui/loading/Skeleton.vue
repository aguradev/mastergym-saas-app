<template>
    <div class="w-full">
        <div class="flex space-x-4 animate-pulse">
            <div class="flex-1">
                <div class="grid gap-4 mb-4 lg:grid-cols-2">
                    <div v-for="count in Array.from({ length: 4 })">
                        <div class="w-40 h-4 mb-4 rounded bg-slate-700"></div>
                        <div class="h-4 mb-4 rounded w-54 bg-slate-700"></div>
                    </div>
                </div>
                <div class="grid gap-4 lg:grid-cols-2">
                    <div v-for="count in Array.from({ length: 4 })">
                        <div class="w-64 h-4 mb-4 rounded bg-slate-700"></div>
                        <div class="w-48 h-4 mb-4 rounded bg-slate-700"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
