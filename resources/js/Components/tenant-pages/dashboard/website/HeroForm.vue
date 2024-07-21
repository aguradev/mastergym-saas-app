<script setup>
import { useForm, usePage, router } from '@inertiajs/vue3';
import { computed, toRefs, watch, nextTick, ref } from 'vue';

import InputGroup from '@components/ui/group/InputGroup.vue';
import InputText from '@components/elements/input/InputText.vue';
import InputFile from '@components/elements/input/InputFile.vue';
import ValidationMessage from '@components/ui/cta/ValidationMessage.vue';
import PrimaryButton from '@components/elements/button/PrimaryButton.vue';
import PreviewImage from '@components/tenant-pages/dashboard/ultility/PreviewImage.vue'

const { props } = toRefs(usePage());
const { hero } = props.value;
const imgComponentKey = ref(0);

const form = useForm({
    title: hero.title,
    btnLeft: hero.btnLeft,
    btnRight: hero.btnRight,
    imageURL: hero.image,
    image: "",
})
const { title, btnLeft, btnRight, imageURL } = toRefs(form)

let imgUrl = ref(`/public/storage/${imageURL.value}?t=${Date.now()}`);

function updateImageKey() {
    imgComponentKey.value++;
}

function editHandler() {
    if (!form.image) {
        form.image = hero.image;
    }

    form.post(route("website.hero.update", {
        _method: 'put',
        onSuccess: () => form.reset('image'),
    }));
}

watch(() => props.value, (newVal, oldVal) => {
    hero.title = newVal.hero.title;
    hero.btnLeft = newVal.hero.btnLeft;
    hero.btnRight = newVal.hero.btnRight;
    hero.imageURL = newVal.hero.image;

    imgUrl = `/public/storage/${newVal.hero.image}?t=${Date.now()}`;

    updateImageKey();
});

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
            <InputGroup label="Hero Right Button" labelFor="right-button">
                <InputText inputId="btnRight" inputPlaceholder="Right button text of your Hero here!"
                    inputName="right_button" v-model:inputValue="btnRight" />
                <ValidationMessage v-if="form.errors.btnRight" :caption="form.errors.btnRight" />
            </InputGroup>
            <InputGroup label="Hero Background Image" labelFor="background_input">
                <InputFile inputId="image" inputType="file" inputPlaceholder="Background Image of your Hero here!"
                    inputName="background_input" @update:inputValue="(file) => { form.image = file; }" />
            </InputGroup>
        </div>
        <div class="flex justify-between mb-4">
            <div class="w-[400px]">
                <PreviewImage :key="imgComponentKey" :img="imgUrl" :number="imgComponentKey" :title="hero.title" />
            </div>
            <div class="">
                <PrimaryButton type="submit" label="Update Data" />
            </div>
        </div>
    </form>
</template>