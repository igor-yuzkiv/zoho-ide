import {
    createRouter,
    createWebHistory
} from 'vue-router'

import routesName from "@/constans/routesName.js";
import DefaultLayout from "@/layout/default/DefaultLayout.vue";

const router = createRouter({
    history: createWebHistory(import.meta.env.VITE_APP_BASE_WEB_URI),
    routes : [
        {
            path     : "/",
            component: DefaultLayout,
            children : [
                {
                    path     : '/',
                    name     : routesName.home,
                    component: () => import('@/views/home/HomeView.vue'),
                },
            ],
        },
    ]
})

export default router
