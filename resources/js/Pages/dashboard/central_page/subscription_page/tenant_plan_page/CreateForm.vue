<script setup>
import PrimaryButton from '@components/elements/button/PrimaryButton.vue';
import InputText from '@components/elements/input/InputText.vue';
import ValidationMessage from '@components/ui/cta/ValidationMessage.vue';
import { useForm } from '@inertiajs/vue3';
import axiosHttp from '@lib/axios';
import MultiSelect from 'primevue/multiselect';
import { onMounted, ref, toRefs, watch } from 'vue';
import { route } from 'ziggy-js'

const form = useForm({
    title: "",
    price_per_month: "",
    price_per_year: "",
    features: null
})

const { title, price_per_month, price_per_year, features } = toRefs(form)
const featureLists = ref(null)
const loadingForm = ref(true);
function submitHandler() {
    form.post(route('plan_tenant.create'), {
        onSuccess: () => {
            form.reset();
        }
    });
}

async function fetchingFeatures() {
    try {
        const res = await axiosHttp.get(route('plan_feature.json.all'))

        if (res.status == 200) {
            featureLists.value = res.data;
        }

    } catch (err) {
        console.log(err)
    } finally {
        loadingForm.value = false
    }
}

onMounted(async () => {
    await fetchingFeatures();
})

watch(() => features.value, (val) => {
    console.log(val)
})
</script>

<template>
    <section class="plan_tenant_create_form">
        <div v-if="loadingForm">
            Loading...
        </div>
        <form v-if="!loadingForm" @submit.prevent="submitHandler" autocomplete="off">
            <div class="inline-flex flex-col w-full mb-5 gap-y-3" v-if="featureLists">
                <label for="feature" class="block">Features</label>
                <MultiSelect v-model="features" :options="featureLists.results" optionLabel="name"
                    placeholder="Select Features" max-selected-labels="4" filter />
                <ValidationMessage v-if="form.errors.features" :caption="form.errors.features" />
            </div>
            <div class="inline-flex flex-col w-full mb-5 gap-y-3">
                <label for="title" class="block">Title</label>
                <InputText inputId="title" v-model:model-value="title" />
                <ValidationMessage v-if="form.errors.title" :caption="form.errors.title" />
            </div>
            <div class="grid lg:grid-cols-2 gap-x-8">
                <div class="inline-flex flex-col w-full mb-5 gap-y-3 md:mb-0">
                    <label for="price_per_month" class="block">Price per month</label>
                    <InputText inputId="price_per_month" v-model:model-value="price_per_month" />
                    <ValidationMessage v-if="form.errors.price_per_month" :caption="form.errors.price_per_month" />

                </div>
                <div class="inline-flex flex-col w-full gap-y-3">
                    <label for="price_per_year" class="block">Price per year</label>
                    <InputText inputId="price_per_year" v-model:model-value="price_per_year" />
                    <ValidationMessage v-if="form.errors.price_per_year" :caption="form.errors.price_per_year" />
                </div>
            </div>

            <div class="mt-8">
                <PrimaryButton type="submit" label="Submit" />
            </div>
        </form>
    </section>
</template>
