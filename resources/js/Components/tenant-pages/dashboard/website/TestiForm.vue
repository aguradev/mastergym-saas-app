<script setup>
    import { provide, ref, toRefs } from 'vue';
    import { useForm, usePage } from '@inertiajs/vue3';

    import PopUpModal from '../ultility/PopUpModal.vue';
    import PrimaryButton from '@components/elements/button/PrimaryButton.vue';
    import InputText from '@components/elements/input/InputText.vue';
    import InputTextArea from '@components/elements/input/InputTextArea.vue';
    import InputGroup from '@components/ui/group/InputGroup.vue';
    import ValidationMessage from '@components/ui/cta/ValidationMessage.vue';

    const { props } = toRefs(usePage());
    const { testi } = props.value;

    const openModal = ref(false);
    provide('visibleModal', openModal);

    const form = useForm({
        title: testi.title,
        text: testi.text,
        button: testi.button,
        cards: testi.cards,
    });

    const { title, text, button, cards } = toRefs(form);

    function editHandler() {
        form.post(
            route('website.testimony.update', {
                _method: 'put',
            })
        );
    }

    function getErrorMessage(index, field) {
        return form.errors[`cards.${index}.${field}`];
    }
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
    <form
        action="#"
        @submit.prevent="editHandler"
    >
        <div class="grid grid-cols-2 gap-10 pl-8 py-6">
            <div id="left">
                <PopUpModal image="/public/assets/images/preview/testi-prev.png" />
                <div class="flex gap-10">
                    <span class="text-2xl font-medium pt-2">Edit Tesimony Content</span>
                    <PrimaryButton
                        type="button"
                        label="Preview Layout"
                        @click-event="() => (openModal = true)"
                    />
                </div>
                <InputGroup
                    label="Testimony Title"
                    labelFor="title"
                >
                    <InputText
                        inputId="title"
                        v-model:inputValue="title"
                        name="input_title"
                        input-placeholder="Your testimony title goes here!"
                    />
                    <ValidationMessage
                        v-if="form.errors.title"
                        :caption="form.errors.title"
                    />
                </InputGroup>
                <InputGroup
                    label="Brief Text"
                    labelFor="text"
                >
                    <InputTextArea
                        inputId="text"
                        v-model:inputValue="text"
                        name="input_testi_text"
                        input-placeholder="The brief text for your testimony goes here!"
                    />
                    <ValidationMessage
                        v-if="form.errors.text"
                        :caption="form.errors.text"
                    />
                </InputGroup>
                <InputGroup
                    label="Button text"
                    labelFor="button"
                >
                    <InputText
                        inputId="button"
                        v-model:inputValue="button"
                        name="input_button_text"
                        input-placeholder="Your button text goes here!"
                    />
                </InputGroup>
                <div class="flex justify-end">
                    <PrimaryButton
                        type="submit"
                        label="Update Data"
                    />
                </div>
            </div>
            <div
                id="right"
                class="overflow-y-scroll max-h-[750px]"
            >
                <div
                    v-for="(card, index) in cards"
                    class="pt-4 mr-4"
                >
                    <p class="text-md font-medium">Testimony Card Number {{ index + 1 }}</p>
                    <div class="px-4 py-2 mt-4 bg-primary-800 rounded-lg">
                        <InputGroup
                            label="Testimony Title"
                            lableFor="card-title"
                        >
                            <InputText
                                inputId="card-title"
                                v-model:inputValue="card.title"
                                input-placeholder="Your Card title Goes Here"
                            />
                            <ValidationMessage
                                v-if="getErrorMessage(index, 'title')"
                                :caption="getErrorMessage(index, 'title')"
                            />
                        </InputGroup>
                        <InputGroup
                            label="Testimony Text"
                            lableFor="card-title"
                        >
                            <InputTextArea
                                inputId="card-title"
                                v-model:inputValue="card.text"
                                input-placeholder="Your Card title Goes Here"
                            />
                            <ValidationMessage
                                v-if="getErrorMessage(index, 'text')"
                                :caption="getErrorMessage(index, 'text')"
                            />
                        </InputGroup>
                        <InputGroup
                            label="Testimony Writer"
                            lableFor="card-title"
                        >
                            <InputText
                                inputId="card-title"
                                v-model:inputValue="card.name"
                                input-placeholder="Your Card title Goes Here"
                            />
                            <ValidationMessage
                                v-if="getErrorMessage(index, 'name')"
                                :caption="getErrorMessage(index, 'name')"
                            />
                        </InputGroup>
                        <InputGroup
                            label="Testimony Rating"
                            lableFor="card-title"
                            note="*the input is between 1 and 5*"
                        >
                            <InputText
                                inputId="card-title"
                                inputType="number"
                                v-model:inputValue="card.stars"
                                input-placeholder="Your Card title Goes Here"
                            />
                            <ValidationMessage
                                v-if="getErrorMessage(index, 'stars')"
                                :caption="getErrorMessage(index, 'stars')"
                            />
                        </InputGroup>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>
