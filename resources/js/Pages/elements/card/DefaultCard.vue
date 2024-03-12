<script setup>
import Card from 'primevue/card';
</script>

<template>
    <Card
        :pt="{ title: 'mb-4 text-xl font-semibold', body: 'p-7', content: 'py-0', root: 'bg-primary-800 rounded-lg' }">
        <template #title>
            <slot name="card__title" />
        </template>
        <template #content>
            <slot name="card__content" />
        </template>
    </Card>
</template>
