<script setup>
import InputText from '@/elements/input/InputText.vue';
import PrimaryButton from '@/elements/button/PrimaryButton.vue';
import { onMounted, reactive, ref, watch, watchEffect } from 'vue'
import { router } from '@inertiajs/vue3';

const inputItems = ref(1)
const inputFeatureRefs = reactive({
    "input_feature[]": []
})

const disableButtonPlus = ref(false)
const formFeature = ref(null)

function addInputFeature() {
    inputItems.value++
}

function submitAddFeature() {
    const formData = new FormData(formFeature.value);
    const getAllInput = formData.getAll("input_feature[]");

    router.post("plan-feature/create", {
        data: getAllInput,
    });
}

watch(inputItems, (newVal, prevVal) => {
    disableButtonPlus.value = newVal >= 3 ? true : false
})

</script>

<style>
.features_form_input {
    @apply relative;
}
</style>

<template>
    <div class="feature_form_input">
        <form action="#" method="post" @submit.prevent="submitAddFeature" autocomplete="off" ref="formFeature">
            <div class="mb-6">
                <div v-for="_, index in Array.from({ length: inputItems })" class="mb-4" :key="index">
                    <InputText id="feature__name" type="text" placeholder="input feature name"
                        inputName="input_feature[]" v-model:inputValue="inputFeatureRefs['input_feature[]'][index]" />
                </div>
                <PrimaryButton type="button" icon="pi pi-plus" classBtn="bg-primary-700 p-3 rounded text-sm"
                    @click-event="addInputFeature" v-if="!disableButtonPlus" />
            </div>
            <PrimaryButton type="submit" label="Submit" />
        </form>
    </div>
</template>
