import { createRouter, createWebHistory } from 'vue-router';

import Home from '../Pages/Home.vue';
import Sobre from '../Pages/Sobre.vue';
import Ong from '../Pages/Ong.vue';

const siteName = ' - Mão Amiga';

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home,
        meta: { title: 'Home'},
    },
    {
        path: '/sobre',
        name: 'Sobre',
        component: Sobre,
        meta: { title: 'Sobre'}
    },
    {
        path: '/ong',
        name: 'ONGs',
        component: Ong,
        meta: { title: 'ONGs'}
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.afterEach((to) => {
    if (to.meta.title) {
        document.title = to.meta.title + siteName;
    } else {
        document.title = siteName.slice(3);
    }
});

export default router;