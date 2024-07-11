import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useContentMenus = defineStore('content_menus', () => {
    const contentMenus = ref([
        { title: 'Overview', url: route('website.overview') },
        { title: 'Hero', url: route('website.hero') },
        { title: 'CTA', url: route('website.cta') },
    ]);

    return { contentMenus };
});
