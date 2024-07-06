<script setup>
import { onMounted, ref, toRef, watch } from "vue";

const { radioName, radioId, label, note, paymentSelect } = defineProps({
    radioName: String,
    radioId: String,
    label: String,
    paymentSelect: {
        type: Boolean,
        default: false,
    },
});

const getLabel = ref(null);
const emits = defineEmits(["checkedRadioHandler"]);
</script>

<template>
    <div class="mb-4">
        <label
            :for="radioId"
            class="block bg-primary-800 p-6 rounded-lg cursor-pointer"
            :class="[
                paymentSelect ? 'border border-surface-600 font-semibold' : '',
            ]"
            ref="getLabel"
        >
            <h4>{{ label }}</h4>
            <p>{{ note }}</p>
        </label>
        <input
            type="radio"
            :name="radioName"
            :id="radioId"
            hidden
            ref="getRadio"
            :checked="paymentSelect"
            :value="radioId"
            @click="(e) => $emit('checkedRadioHandler', e.target)"
        />
    </div>
</template>
