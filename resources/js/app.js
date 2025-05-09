import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import Layout from './Layouts/Layout.vue';
import '../css/app.css';
import router from './router';

createInertiaApp({
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue')
        ).then((page) => {
            page.default.layout = page.default.layout || Layout;
            return page;
        }),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(router)
            .mount(el);
    },
});