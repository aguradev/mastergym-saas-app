<script setup>
import { reactive, ref, toRefs, watch } from 'vue';
import axiosHttp from '@lib/axios';
import InputText from '@components/elements/input/InputText.vue';
import PrimaryButton from '@components/elements/button/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';
const props = defineProps({
    id: String
})

const { id } = toRefs(props);
const errorMessages = ref(null)

const form = useForm({
    id: null,
    input_feature: null
})
const emits = defineEmits('closeModal')

async function fetchFeatureDetail() {
    try {
        const res = await axiosHttp.get(route('plan_feature.json.detail', {
            tenantPlanFeature: id.value
        }))

        if (res.status == 200) {
            const data = await res.data;
            form.input_feature = data.results?.name;
            form.id = data.results?.id;
        }
    } catch (e) {
        console.log(e);
    }
}

function featureUpdateHandler() {
    form.put(route('plan_feature.update', {
        tenantPlanFeature: form.id
    }), {
        onSuccess: (page) => {
            emits('closeModal')
        },
        onError: (error) => {
            errorMessages.value = error
        }
    })
}

await fetchFeatureDetail();

</script>

<template>
    <form action="#" autocomplete="off" @submit.prevent="featureUpdateHandler" v-if="form.id">
        <div class="flex flex-col mb-6">
            <label for="feature__name" class="block mb-2 font-[500]">Feature name</label>
            <InputText id="feature__name" inputType="text" placeholder="input feature name" inputName="input_feature"
                v-model:inputValue="form.input_feature" :invalid="errorMessages?.input_feature ? true : false" />
            <span class="mt-3 text-danger-300" v-if="errorMessages">
                {{ errorMessages?.input_feature }}
            </span>
        </div>

        <PrimaryButton label="Update" />
    </form>
</template>
