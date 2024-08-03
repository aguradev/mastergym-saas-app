import { defineConfig } from "vite";
import { fileURLToPath, URL } from "node:url";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import path from "path";

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            "@pages": fileURLToPath(
                new URL("./resources/js/Pages", import.meta.url),
            ),
            "@public": fileURLToPath(new URL("./public", import.meta.url)),
            "@components": fileURLToPath(
                new URL("./resources/js/Components", import.meta.url),
            ),
            "@layouts": fileURLToPath(
                new URL("./resources/js/Layouts", import.meta.url),
            ),
            "@stores": fileURLToPath(
                new URL("./resources/js/Stores", import.meta.url),
            ),
            "@lib": fileURLToPath(
                new URL("./resources/js/Lib", import.meta.url),
            ),
            "@dashboardCentralPageComponents": fileURLToPath(
                new URL(
                    "./resources/js/Components/central-pages/dashboard",
                    import.meta.url,
                ),
            ),
            "ziggy-js": path.resolve("vendor/tightenco/ziggy"),
        },
    },
});
