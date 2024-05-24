import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import Pages from 'vite-plugin-pages'
import Vue from '@vitejs/plugin-vue';
import Components from 'unplugin-vue-components/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        Pages({
            dirs: [
                { dir: 'resources/vue/pages', baseRoute: '' },
            ],
            extensions: ['vue'],
            extendRoute(route, parent) {
                if (route.path === '/' || route.path === '/auths/login') {
                    return route
                }
                return {
                    ...route,
                    meta: { auth: true },
                }
            },
        }),
        Vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
});
