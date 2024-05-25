<script setup>
import Button from 'primevue/button';
import { onMounted } from 'vue'

const props = defineProps([
    "label", "type", "icon", "classBtn", 'disabled'
])

const { label, type, icon, classBtn } = props

const emits = defineEmits(["clickEvent"])

</script>

<template>
    <Button
        :pt="{ root: classBtn ? classBtn : 'flex justify-center gap-x-2 items-center bg-surface-600 px-4 text-base py-4 rounded-xl text-white hover:bg-surface-700' }"
        :type="type" :icon="icon" :label="label" @click="emits('clickEvent')" />
</template>
