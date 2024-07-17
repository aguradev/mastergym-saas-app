<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import { computed, toRefs } from 'vue';

import InputGroup from '@components/ui/group/InputGroup.vue';
import InputText from '@components/elements/input/InputText.vue';
import InputFile from '@components/elements/input/InputFile.vue';
import ValidationMessage from '@components/ui/cta/ValidationMessage.vue';
import PrimaryButton from '@components/elements/button/PrimaryButton.vue';

const page = usePage()
const { hero } = toRefs(page.props)

const parsedHero = computed(() => {
    try {
        return JSON.parse(hero.value);
    } catch (e) {
        console.log('error parsing hero value', e);
    }
})

const bg = computed(() => {
    return new URL(`${parsedHero.value.image}`, import.meta.url).href
})

const form = useForm({
    title: parsedHero.value.title,
    btnLeft: parsedHero.value.btnLeft,
    btnRight: parsedHero.value.btnRight,
    image: "",
})

// /public/assets/images/preview/hero.png

const { title, btnLeft, btnRight, image } = toRefs(form);

function editHandler() {
    if (!form.image) {
        form.image = parsedHero.value.image;
    }

    form.post(route("website.hero.update", {
        _method: 'put',
        onSuccess: () => form.reset('image'),
    }));
}

</script>

<template>
    <form action="#" autocomplete="off" @submit.prevent="editHandler">
        <div>
            <InputGroup label="Hero Title" labelFor="title-input">
                <InputText inputId="title" inputPlaceholder="Title of your Hero here!" inputName="title_input"
                    v-model:inputValue="title" />
                <ValidationMessage v-if="form.errors.title" :caption="form.errors.title" />
            </InputGroup>
            <InputGroup label="Left Button" labelFor="left-button">
                <InputText inputId="btnLeft" inputPlaceholder="Left button text of your Hero here!"
                    inputName="left_button" v-model:inputValue="btnLeft" />
                <ValidationMessage v-if="form.errors.btnLeft" :caption="form.errors.btnLeft" />
            </InputGroup>
            <InputGroup label="Hero Title" labelFor="right-button">
                <InputText inputId="btnRight" inputPlaceholder="Right button text of your Hero here!"
                    inputName="right_button" v-model:inputValue="btnRight" />
                <ValidationMessage v-if="form.errors.btnRight" :caption="form.errors.btnRight" />
            </InputGroup>
            <InputGroup label="Hero Background Image" labelFor="background_input">
                <!-- <InputText inputId="image" inputType="text" inputPlaceholder="Background Image of your Hero here!"
                    inputName="background_input" v-model:inputValue="image" /> -->
                <InputFile inputId="image" inputType="file" inputPlaceholder="Background Image of your Hero here!"
                    inputName="background_input" @update:inputValue="(file) => { form.image = file; }" />
            </InputGroup>
        </div>
        <div class="flex justify-between">
            <div class="">
                <p>Image Currently Used</p>
                <img :src="bg" alt="" class="w-[200px] mt-2">
            </div>
            <div class="">
                <PrimaryButton type="" label="Update Data" />
            </div>
        </div>
    </form>
</template>