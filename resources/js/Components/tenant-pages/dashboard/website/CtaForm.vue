<script setup>
    import { useForm, usePage } from '@inertiajs/vue3';
    import { provide, ref, toRefs } from 'vue';

    import InputGroup from '@components/ui/group/InputGroup.vue';
    import InputText from '@components/elements/input/InputText.vue';
    import InputTextArea from '@components/elements/input/InputTextArea.vue';
    import InputFile from '@components/elements/input/InputFile.vue';
    import PreviewImage from '../ultility/PreviewImage.vue';
    import PrimaryButton from '@components/elements/button/PrimaryButton.vue';
    import ValidationMessage from '@components/ui/cta/ValidationMessage.vue';
    import PopUpModal from '../ultility/PopUpModal.vue';
    import { watch } from 'vue';

    const { props } = toRefs(usePage());
    const { cta } = props.value;
    const imgComponentKey = ref(0);

    const openModal = ref(false);
    provide('visibleModal', openModal);

    const form = useForm({
        header: cta.header,
        text: cta.text,
        button: cta.button,
        imageURL: cta.image,
        image: '',
    });
    const { header, text, button, imageURL } = toRefs(form);

    let imgUrl = ref(imageURL.value);

    function updateImageKey() {
        imgComponentKey.value++;
    }

    function editHandler() {
        if (!form.image) {
            form.image = cta.image;
        }

        form.post(
            route('website.cta.update', {
                _method: 'put',
                onSuccess: () => {
                    form.reset('image');
                    form.clearErrors();
                },
            })
        );
    }

    watch(
        () => props.value,
        (newVal) => {
            cta.header = newVal.cta.header;
            cta.text = newVal.cta.text;
            cta.button = newVal.cta.button;
            cta.imageURL = newVal.cta.image;

            imgUrl = `${newVal.cta.image}`;

            updateImageKey();
        }
    );
</script>

<template>
    <form
        action="#"
        @submit.prevent="editHandler"
    >
        <div class="pr-10">
            <PopUpModal image="/public/assets/images/preview/cta-prev.png" />
            <div class="flex gap-7">
                <span class="text-2xl font-medium pt-2">Edit Call to Action Content</span>
                <PrimaryButton
                    type="button"
                    label="Preview Layout"
                    @click-event="() => (openModal = true)"
                />
            </div>
            <InputGroup
                labelFor="header"
                label="Header Text"
            >
                <InputText
                    v-model:inputValue="header"
                    inputType="text"
                    inputId="header"
                    inputName="header"
                    inputPlaceholder="Your call to action header text goes here!"
                />
                <ValidationMessage
                    v-if="form.errors.header"
                    :caption="form.errors.header"
                />
            </InputGroup>
            <InputGroup
                labelFor="text"
                label="Text Paragraph"
            >
                <InputTextArea v-model:inputValue="text" />
                <ValidationMessage
                    v-if="form.errors.text"
                    :caption="form.errors.text"
                />
            </InputGroup>
            <InputGroup
                labelFor="button"
                label="Button Text"
            >
                <InputText
                    v-model:inputValue="button"
                    inputType="text"
                    inputId="button"
                    inputName=""
                    inputPlaceholder="Your button's text goes here!"
                />
                <ValidationMessage
                    v-if="form.errors.button"
                    :caption="form.errors.button"
                />
            </InputGroup>
            <div class="flex justify-between">
                <div id="">
                    <InputGroup
                        labelFor="image"
                        label="Input Image"
                    >
                        <InputFile
                            inputType="file"
                            inputId="image"
                            inputName="background_image"
                            @update:inputValue="
                                (file) => {
                                    form.image = file;
                                }
                            "
                        />
                        <ValidationMessage
                            v-if="form.errors.image"
                            :caption="form.errors.image"
                        />
                    </InputGroup>
                </div>
                <div class="pt-8">
                    <PrimaryButton
                        type="submit"
                        label="Update Data"
                    />
                </div>
            </div>
            <div class="flex justify-between mb-4">
                <div class="w-[400px]">
                    <p>Image Currently Used</p>
                    <PreviewImage
                        :key="imgComponentKey"
                        :img="imgUrl"
                    />
                </div>
                <div class=""></div>
            </div>
        </div>
    </form>
</template>
