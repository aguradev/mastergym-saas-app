<script setup>
import InputText from '@/elements/input/InputText.vue';
import PrimaryButton from '@/elements/button/PrimaryButton.vue';
import { onMounted, reactive, ref, toRef, toRefs, watch, watchEffect } from 'vue'
import { router, useForm } from '@inertiajs/vue3';

const featureForm = useForm({
    "items": [
        {
            input_feature: ''
        },
    ]
})

const emits = defineEmits(["actionFeatureForm"])
const props = defineProps({
    validationMessages: Array
})

const disableButtonPlus = ref(false)

function addInputFeature() {
    featureForm.items = [...featureForm.items, { input_feature: '' }]
}

function removeInputFeature() {
    featureForm.items.pop();
}

function submitAddFeature() {
    emits("actionFeatureForm", featureForm)
}

watch(featureForm, (newVal) => {
    disableButtonPlus.value = newVal.items.length >= 3 ? true : false
})
</script>

<style>
.features_form_input {
    @apply relative;
}
</style>

<template>
    <div class="feature_form_input">
        <form method="post" @submit.prevent="submitAddFeature" autocomplete="off">
            <div class="mb-6">
                <div v-for="(item, index) in featureForm.items" class="mb-4" :key="index">
                    <InputText id="feature__name" type="text" placeholder="input feature name"
                        inputName="input_feature[]" v-model:inputValue="featureForm.items[index].input_feature"
                        :invalid="featureForm.errors[`items.${index}.input_feature`] ? true : false" />
                    <span class="block mt-2 mb-5 text-sm text-danger-300" v-if="featureForm.hasErrors">{{
                        featureForm.errors[`items.${index}.input_feature`] }}</span>
                </div>
                <div class="flex items-center gap-x-4">
                    <PrimaryButton type="button" icon="pi pi-plus" classBtn="bg-primary-700 p-3 rounded text-sm"
                        @click-event="addInputFeature" v-if="!disableButtonPlus" />
                    <PrimaryButton type="button" icon="pi pi-minus" classBtn="bg-primary-700 p-3 rounded text-sm"
                        @click-event="removeInputFeature" v-if="featureForm.items.length > 1" />
                </div>
            </div>
            <PrimaryButton type="submit" label="Submit" />
        </form>
    </div>
</template>
