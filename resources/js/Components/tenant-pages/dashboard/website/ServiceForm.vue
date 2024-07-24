<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import { ref, toRefs, provide, watch } from 'vue';

import PopUpModal from '../ultility/PopUpModal.vue';
import PrimaryButton from '@components/elements/button/PrimaryButton.vue';
import InputGroup from '@components/ui/group/InputGroup.vue';
import InputText from '@components/elements/input/InputText.vue';
import InputTextArea from '@components/elements/input/InputTextArea.vue';
import PreviewImage from '../ultility/PreviewImage.vue';
import InputFile from '@components/elements/input/InputFile.vue';
import ValidationMessage from '@components/ui/cta/ValidationMessage.vue';

const { props } = toRefs(usePage());
const { service } = props.value;
const imgComponentKey = ref(0)

const openModal = ref(false);
provide("visibleModal", openModal);

const form = useForm({
    title: service.title,
    text: service.text,
    cards: service.cards
});

const { title, text, cards } = toRefs(form);

let imgUrl = toRefs([
    `/public/storage/${cards.value[0].image}?t=${Date.now()}`,
    `/public/storage/${cards.value[1].image}?t=${Date.now()}`,
    `/public/storage/${cards.value[2].image}?t=${Date.now()}`,
    `/public/storage/${cards.value[3].image}?t=${Date.now()}`,
]);

const index = ref(0);
imgUrl.forEach(item => {
    if (item.value.includes("tenant")) {
        imgUrl[index.value].value = `/public/storage/${cards.value[index.value].image}?t=${Date.now()}`;
    } else {
        imgUrl[index.value].value = `${cards.value[index.value].image}?t=${Date.now()}`;
    }
    index.value++
});

function updateImageKey() {
    imgComponentKey.value++;
}

function editHandler() {
    form.post(route('website.service.update', {
        _method: 'put'
    }));
}

watch(() => props.value, (newVal) => {
    service.title = newVal.service.title,
        service.text = newVal.service.text,
        service.cards = newVal.service.cards

    imgUrl[0].value = `/public/storage/${newVal.service.cards[0].image}?t=${Date.now()}`;
    imgUrl[1].value = `/public/storage/${newVal.service.cards[1].image}?t=${Date.now()}`;
    imgUrl[2].value = `/public/storage/${newVal.service.cards[2].image}?t=${Date.now()}`;
    imgUrl[3].value = `/public/storage/${newVal.service.cards[3].image}?t=${Date.now()}`;

    updateImageKey();
})

</script>

<style scoped>
/* width */
::-webkit-scrollbar {
    width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 5px;
}

/* Handle */
::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 5px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: #555;
}
</style>

<template>
    <div class="grid grid-cols-1">
        <form action="#" @submit.prevent="editHandler">
            <div class="grid grid-cols-2 gap-10 pr-2">
                <div id="left">
                    <PopUpModal image="/public/assets/images/preview/service-prev.png" />
                    <div class="flex gap-10">
                        <span class="text-2xl font-medium pt-2">Edit Service Content</span>
                        <PrimaryButton label="Preview Layout" @click-event="() => (openModal = true)" />
                    </div>
                    <InputGroup label="Service Title" label-for="title">
                        <InputText inputId="title" input-placeholder="Your service title goes here"
                            input-name="title_input" v-model:inputValue="title" />
                        <ValidationMessage v-if="form.errors.title" :caption="form.errors.title" />
                    </InputGroup>
                    <InputGroup label="Brief Text" label-for="text">
                        <InputTextArea inputId="text" input-placeholder="Your brief text goes here"
                            input-name="text_input" v-model:inputValue="text" />
                        <ValidationMessage v-if="form.errors.text" :caption="form.errors.text" />
                    </InputGroup>
                    <PrimaryButton type="submit" label="Update Data" />
                </div>
                <div id="right" class="overflow-y-scroll max-h-[750px]">
                    <div v-for="(card, index) in cards" class="pt-4 mr-4">
                        <p class="text-md font-medium"> Card Number {{ index + 1 }}</p>
                        <div class="px-4 mt-2 pt-2 bg-primary-800 rounded-lg">
                            <InputText class="hidden" inputId="id" input-placeholder="Your card name goes here"
                                input-name="card_input" v-model:inputValue="card.id" />
                            <InputGroup label="Card Name" label-for="text">
                                <InputText inputId="card" input-placeholder="Your card name goes here"
                                    input-name="card_input" v-model:inputValue="card.name" />
                                <ValidationMessage v-if="form.errors.text" :caption="form.errors.text" />
                            </InputGroup>
                            <div class="grid grid-cols-2 gap-20">
                                <div>
                                    <InputGroup label="Card Image" label-for="cardImage">
                                        <InputFile inputId="cardImage" inputType="file" input-name="gym_icon_input"
                                            @update:inputValue="(file) => { form.cards[index].image = file; }" />
                                    </InputGroup>
                                </div>
                                <div>
                                    <p class="pt-2">Currently Used Icon</p>
                                    <PreviewImage :key="imgComponentKey" :img="imgUrl[index].value" />
                                </div>
                            </div>
                            <ValidationMessage v-if="form.errors.cards" :caption="form.errors.cards" />
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>