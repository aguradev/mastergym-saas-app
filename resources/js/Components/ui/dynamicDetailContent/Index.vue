<script setup>
import { toRefs } from "vue";

const props = defineProps({
    classLabel: "",
    classCaption: "",
    label: String,
    caption: String,
});

const { classLabel, classCaption, label, caption } = toRefs(props);
</script>
<template>
    <div class="mb-8">
        <h4
            :class="`${classLabel ? classLabel : ''} mb-3 text-base font-semibold capitalize`"
        >
            {{ label }}
        </h4>
        <p :class="`${classCaption ? classCaption : ''} text-base`">
            {{ caption }}
        </p>
    </div>
</template>
