<script setup>
import { router } from '@inertiajs/vue3';
import { toRefs, onMounted, onUnmounted, ref } from 'vue';
import { route } from 'ziggy-js';

const props = defineProps({
    modalVisible: Boolean,
    id: String
})

const { modalVisible, id } = toRefs(props);
const emits = defineEmits(["closeFeatureDetail"])
const featureDataDetail = ref([]);

async function fetchFeatureDetail() {
    const res = await fetch(route('plan_feature.json.detail', {
        tenantPlanFeature: id.value
    }), {
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })

    if (res.ok) {
        const data = await res.json();
        featureDataDetail.value = { ...data.results };
    }
}

onMounted(() => {
    document.body.classList.add("overflow-hidden");
    fetchFeatureDetail();
})

onUnmounted(() => {
    document.body.classList.remove("overflow-hidden")
})

</script>

<template>
    <div class="fixed top-0 left-0 w-full h-full grid place-content-center bg-primary-800/60 z-[99] px-8">
        <div class="p-8 border rounded-lg bg-primary-700 border-surface-500 min-w-[800px]">
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-2xl font-semibold">Feature Detail</h3>
                <button type="button" @click="$emit('closeFeatureDetail')">x</button>
            </div>

            <div>
                <h4>Name:</h4>
                <p>{{ featureDataDetail.name }}</p>
            </div>

        </div>
    </div>
</template>
