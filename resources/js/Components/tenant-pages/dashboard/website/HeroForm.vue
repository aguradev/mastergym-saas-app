<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import { ref, computed, toRefs, toRef, watch } from 'vue';

import InputGroup from '@components/ui/group/InputGroup.vue';
import InputText from '@components/elements/input/InputText.vue';
import InputFile from '@components/elements/input/InputFile.vue';
import ValidationMessage from '@components/ui/cta/ValidationMessage.vue';
import PrimaryButton from '@components/elements/button/PrimaryButton.vue';
import PreviewImage from '@components/tenant-pages/dashboard/ultility/PreviewImage.vue'

const { props } = toRefs(usePage());

const { parsed } = props.value;

const imgUrl = "/public/storage/" + parsed.image;

let bgi = computed(() => {
    return new URL(`${imgUrl.value}`, import.meta.url).href
})


const form = useForm({
    title: parsed.title,
    btnLeft: parsed.btnLeft,
    btnRight: parsed.btnRight,
    image: "",
})

const { title, btnLeft, btnRight } = toRefs(form)


function editHandler() {
    if (!form.image) {
        form.image = parsed.image;
    }

    form.post(route("website.hero.update", {
        _method: 'put',
    }));

    console.table(parsed);
}

watch(() => props.value, (newVal, oldVal) => console.log(newVal.parsed))

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
                <p>Background Image Currently Used</p>
                <p>Img Url : {{ imgUrl }}</p>
                <img :src="bgi" alt="" class="w-[200px] mt-2">
                <PreviewImage :img="imgUrl" />
            </div>
            <div class="">
                <PrimaryButton type="" label="Update Data" />
            </div>
        </div>
    </form>
</template>