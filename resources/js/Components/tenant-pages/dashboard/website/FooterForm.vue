<script setup>
    import { useForm, usePage } from '@inertiajs/vue3';
    import { provide, ref, toRefs, watch } from 'vue';

    import PrimaryButton from '@components/elements/button/PrimaryButton.vue';
    import PopUpModal from '@components/tenant-pages/dashboard/ultility/PopUpModal.vue';
    import InputGroup from '@components/ui/group/InputGroup.vue';
    import InputFile from '@components/elements/input/InputFile.vue';
    import InputText from '@components/elements/input/InputText.vue';
    import InputTextArea from '@components/elements/input/InputTextArea.vue';
    import ValidationMessage from '@components/ui/cta/ValidationMessage.vue';
    import PreviewImage from '../ultility/PreviewImage.vue';

    const { props } = toRefs(usePage());
    const { footer } = props.value;
    const imgComponentKey = ref(0);

    const openModal = ref(false);
    provide('visibleModal', openModal);

    const form = useForm({
        gymIcon: '',
        iconUrl: footer.gymIcon,
        gymTitle: footer.gymTitle,
        briefText: footer.briefText,
        menus1: footer.menus[0],
        menus2: footer.menus[1],
        menus3: footer.menus[2],
        menus4: footer.menus[3],
        menus5: footer.menus[4],
        twitter: footer.twitter,
        facebook: footer.facebook,
        instagram: footer.instagram,
    });

    const { iconUrl, gymTitle, briefText, menus1, menus2, menus3, menus4, menus5, twitter, facebook, instagram } = toRefs(form);

    let imgUrl = ref(`/public/storage/${iconUrl.value}?t=${Date.now()}`);

    if (iconUrl.value.includes('tenant')) {
        imgUrl = `/public/storage/${iconUrl.value}?t=${Date.now()}`;
    } else {
        imgUrl = `${iconUrl.value}?t=${Date.now()}`;
    }

    function updateImageKey() {
        imgComponentKey.value++;
    }

    function editHandler() {
        if (!form.gymIcon) {
            form.gymIcon = footer.gymIcon;
        }

        form.post(
            route('website.footer.update', {
                _method: 'put',
            })
        );
    }

    watch(
        () => props.value,
        (newVal) => {
            (footer.iconUrl = newVal.footer.gymIcon),
                (footer.gymTitle = newVal.footer.gymTitle),
                (footer.briefText = newVal.footer.briefText),
                (footer.menus1 = newVal.footer.menus[0]),
                (footer.menus2 = newVal.footer.menus[1]),
                (footer.menus3 = newVal.footer.menus[2]),
                (footer.menus4 = newVal.footer.menus[3]),
                (footer.menus5 = newVal.footer.menus[4]),
                (footer.twitter = newVal.footer.twitter),
                (footer.facebook = newVal.footer.facebook),
                (footer.instagram = newVal.footer.instagram);

            if (newVal.footer.gymIcon.includes('tenant')) {
                imgUrl = `/public/storage/${newVal.footer.gymIcon}?t=${Date.now()}`;
            } else {
                imgUrl = `${newVal.footer.gymIcon}?t=${Date.now()}`;
            }

            updateImageKey();
        }
    );
</script>

<template>
    <div class="grid grid-cols-1 pt-6 px-8">
        <PopUpModal image="/public/assets/images/preview/footer-prev.png" />
        <div class="flex gap-10">
            <span class="text-2xl font-medium pt-2">Edit Footer Content</span>
            <PrimaryButton
                label="Preview Layout"
                type="button"
                @click-event="() => (openModal = true)"
            />
        </div>
        <form
            action="#"
            autocomplete="off"
            @submit.prevent="editHandler"
        >
            <div class="grid grid-cols-2 gap-10 pt-5">
                <div id="left">
                    <InputGroup
                        label="Gym Title"
                        label-for="gymTitle"
                    >
                        <InputText
                            inputId="gymTitle"
                            input-placeholder="Your gym title goes here"
                            input-name="gym_title_input"
                            v-model:inputValue="gymTitle"
                        />
                        <ValidationMessage
                            v-if="form.errors.gymTitle"
                            :caption="form.errors.gymTitle"
                        />
                    </InputGroup>
                    <InputGroup
                        label="Brief Text"
                        label-for="briefText"
                    >
                        <InputTextArea
                            inputId="briefText"
                            input-placeholder="Your footer brief text goes here"
                            input-name="gym_text_input"
                            v-model:inputValue="briefText"
                        />
                        <ValidationMessage
                            v-if="form.errors.briefText"
                            :caption="form.errors.briefText"
                        />
                    </InputGroup>
                    <InputGroup
                        label="Gym Icon"
                        label-for="gymIcon"
                    >
                        <InputFile
                            inputId="gymIcon"
                            inputType="file"
                            input-name="gym_icon_input"
                            @update:inputValue="
                                (file) => {
                                    form.gymIcon = file;
                                }
                            "
                        />
                        <ValidationMessage
                            v-if="form.errors.gymIcon"
                            :caption="form.errors.gymIcon"
                        />
                    </InputGroup>
                    <p class="pt-2">Currently Used Icon</p>
                    <PreviewImage
                        :key="imgComponentKey"
                        :img="imgUrl"
                    />
                </div>
                <div id="right">
                    <InputGroup
                        label="Footer Menus"
                        label-for="menus"
                    >
                        <div class="grid grid-cols-5 grid-rows-1 gap-4">
                            <div>
                                <InputText
                                    inputId="menus1"
                                    input-placeholder="Menu 1"
                                    input-name="footer_menu_input1"
                                    v-model:inputValue="menus1"
                                />
                                <ValidationMessage
                                    v-if="form.errors.menus1"
                                    :caption="form.errors.menus1"
                                />
                            </div>
                            <div>
                                <InputText
                                    inputId="menus2"
                                    input-placeholder="Menu 2"
                                    input-name="footer_menu_input2"
                                    v-model:inputValue="menus2"
                                />
                                <ValidationMessage
                                    v-if="form.errors.menus2"
                                    :caption="form.errors.menus2"
                                />
                            </div>
                            <div>
                                <InputText
                                    inputId="menus3"
                                    input-placeholder="Menu 3"
                                    input-name="footer_menu_input3"
                                    v-model:inputValue="menus3"
                                />
                                <ValidationMessage
                                    v-if="form.errors.menus3"
                                    :caption="form.errors.menus3"
                                />
                            </div>
                            <div>
                                <InputText
                                    inputId="menus4"
                                    input-placeholder="Menu 4"
                                    input-name="footer_menu_input4"
                                    v-model:inputValue="menus4"
                                />
                                <ValidationMessage
                                    v-if="form.errors.menus4"
                                    :caption="form.errors.menus4"
                                />
                            </div>
                            <div>
                                <InputText
                                    inputId="menus5"
                                    input-placeholder="Menu 5"
                                    input-name="footer_menu_input5"
                                    v-model:inputValue="menus5"
                                />
                                <ValidationMessage
                                    v-if="form.errors.menus5"
                                    :caption="form.errors.menus5"
                                />
                            </div>
                        </div>
                    </InputGroup>
                    <InputGroup
                        label="Twitter Link"
                        label-for="twitter"
                    >
                        <InputText
                            inputId="twitter"
                            input-placeholder="Your twitter link goes here"
                            input-name="twitter_link_input"
                            v-model:inputValue="twitter"
                        />
                        <ValidationMessage
                            v-if="form.errors.twitter"
                            :caption="form.errors.twitter"
                        />
                    </InputGroup>
                    <InputGroup
                        label="Facebook Link"
                        label-for="facebook"
                    >
                        <InputText
                            inputId="facebook"
                            input-placeholder="Your facebook link goes here"
                            input-name="facebook_link_input"
                            v-model:inputValue="facebook"
                        />
                        <ValidationMessage
                            v-if="form.errors.facebook"
                            :caption="form.errors.facebook"
                        />
                    </InputGroup>
                    <InputGroup
                        label="Instagram Link"
                        label-for="instagram"
                    >
                        <InputText
                            inputId="instagram"
                            input-placeholder="Your instagram link goes here"
                            input-name="instagram_link_input"
                            v-model:inputValue="instagram"
                        />
                        <ValidationMessage
                            v-if="form.errors.instagram"
                            :caption="form.errors.instagram"
                        />
                    </InputGroup>
                    <div class="flex justify-end">
                        <PrimaryButton
                            type="submit"
                            label="Update Data"
                        />
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
