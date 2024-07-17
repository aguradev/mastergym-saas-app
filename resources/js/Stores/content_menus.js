import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useContentMenus = defineStore('content_menus', () => {
    const contentMenus = ref([
        { title: 'Overview', url: route('website.overview') },
        { title: 'Nav', url: route('website.nav') },
        { title: 'Hero', url: route('website.hero') },
        { title: 'CTA', url: route('website.cta') },
        { title: 'Service', url: route('website.service') },
        { title: 'Membership', url: route('website.membership') },
        { title: 'Testimony', url: route('website.testimony') },
        { title: 'Footer', url: route('website.footer') },
    ]);

    return { contentMenus };
});
