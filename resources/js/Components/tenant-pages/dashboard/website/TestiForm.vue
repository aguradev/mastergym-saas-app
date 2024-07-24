<script setup>
import { provide, ref, toRefs } from 'vue';
import { usePage } from '@inertiajs/vue3'

import PopUpModal from '../ultility/PopUpModal.vue';
import PrimaryButton from '@components/elements/button/PrimaryButton.vue';
import InputText from '@components/elements/input/InputText.vue';
import InputTextArea from '@components/elements/input/InputTextArea.vue';

const { props } = toRefs(usePage());
const { testi } = props.value;

const openModal = ref(false);
provide("visibleModal", openModal)
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
    <div>
        <p>title = {{ testi.title }}</p>
        <p>y</p>
        <p>text = {{ testi.text }}</p>
        <p>y</p>
        <p>cards = {{ testi.cards[0] }}</p>
        <p>y</p>
        <p>button = {{ testi.button }}</p>
    </div>
    <form action="#" @submit.prevent="editHandler">
        <div class="grid grid-cols-2 gap-10">
            <div id="left">
                <PopUpModal image="/public/assets/images/preview/testi-prev.png" />
                <div class="flex gap-10">
                    <span class="text-2xl font-medium pt-2">Edit Tesimony Content</span>
                    <PrimaryButton label="Preview Layout" @click-event="() => (openModal = true)" />
                </div>
            </div>
            <div id="right">
                right
            </div>
        </div>
    </form>
</template>