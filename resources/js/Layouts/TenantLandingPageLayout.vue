<script setup>
import { onMounted, ref  } from 'vue'
import Nav from "@components/tenant-pages/landingPage/Nav.vue";
import TenantFooter from "@components/tenant-pages/landingPage/TenantFooter.vue";

const fetchFooterItems = async() => {
    return [
        { gymTitle: "Gym Tenant",
        briefText: "Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit.",
        menus: [
            "company",
            "about",
            "features",
            "works",
            "works",
            ],
        twitter: "https://twitter.com",
        facebook: "https://facebook.com",
        instagram: "https://instagram.com",
        github: "https://github.com",
        copyright: "© Copyright 2024, All Rights Reserved by Gym Master"
        },
    ]
}

const FooterData = ref ({
        gymTitle: 'test title',
        briefText: 'test brief text',
        menus: ["test1","test2"],
        twitter: 'tweet',
        facebook: 'face',
        instagram: 'insta',
        github: 'git',
        copyright: "dawdaw",
        
})

onMounted(async () => {
    const data = await fetchFooterItems();
    FooterData.value = data[0]
})
</script>

<template>
    <Nav />
    <article>
        <slot />
        <TenantFooter :gym-title="FooterData.gymTitle" :brief-text="FooterData.briefText" :menus="FooterData.menus" :twitter="FooterData.twitter" :facebook="FooterData.facebook" :instagram="FooterData.instagram" :github="FooterData.github"/>
    </article>
</template>
