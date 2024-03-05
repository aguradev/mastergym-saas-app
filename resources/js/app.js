import "./bootstrap";
import { createApp, h } from "vue";
import { ZiggyVue } from "ziggy-js";
import { createInertiaApp } from "@inertiajs/vue3";
import PrimeVue from "primevue/config";
import primevue_preset from "./Preset/primevue_preset";
import "primeicons/primeicons.css";
import { createPinia } from "pinia";

const appName = import.meta.env.VITE_APP_NAME;

createInertiaApp({
    title: (title) => `${appName} - ${title}`,
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        return pages[`./Pages/${name}.vue`];
    },
    setup({ el, App, props, plugin }) {
        const pinia = createPinia();
        const app = createApp({
            render: () => h(App, props),
        });
        app.use(plugin, ZiggyVue)
            .use(pinia)
            .use(PrimeVue, {
                unstyled: true,
                pt: primevue_preset,
            })
            .mount(el);

        return app;
    },
});
