<script setup>
    import { computed, onMounted, ref } from 'vue';
    import PreviewImageFile from '../../../../Lib/preview-img';

    const prop = defineProps({
        img: String,
    });

    let image_url = ref(prop.img);
</script>
<template>
    <div>
        <img
            :src="image_url"
            alt=""
            class="w-[200px] mt-2 pb-10"
        />
    </div>
</template>
