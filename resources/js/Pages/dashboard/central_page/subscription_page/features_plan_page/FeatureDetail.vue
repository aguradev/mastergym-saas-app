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
const featureDataDetail = ref(null);
const isLoadingFetchData = ref(true)

async function fetchFeatureDetail() {
    try {
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
    } catch (e) {
        console.log(e);
    } finally {
        isLoadingFetchData.value = false;
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
        <div class="p-8 border rounded-lg bg-primary-700 border-surface-500 w-[400px] lg:min-w-[800px]">
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-2xl font-semibold">Feature Detail</h3>
                <button type="button" @click="$emit('closeFeatureDetail')">x</button>
            </div>

            <div v-if="!isLoadingFetchData">
                <section class="grid mt-8 lg:grid-cols-2 gap-y-8 lg:gap-y-6" v-if="featureDataDetail">
                    <div>
                        <h4 class="mb-3 text-xl font-semibold">Feature</h4>
                        <p class="text-lg">{{ featureDataDetail.name }}</p>
                    </div>
                    <div>
                        <h4 class="mb-3 text-xl font-semibold">Data created</h4>
                        <p class="text-lg">{{ featureDataDetail.date_created_format }}</p>
                    </div>
                    <div>
                        <h4 class="mb-3 text-xl font-semibold">Date updated</h4>
                        <p class="text-lg">{{ featureDataDetail.updated_at ? featureDataDetail.date_updated_format : '-'
                            }}</p>
                    </div>
                </section>
            </div>
            <div v-else>
                <p>Loading...</p>
            </div>
        </div>
    </div>
</template>
