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
                {
                    path     : "/projects",
                    name     : routesName.projects,
                    component: () => import('@/views/projects/ProjectsView.vue'),
                },
                {
                    path     : "/connections/create",
                    name     : routesName.connection_create,
                    component: () => import('@/views/connection/ConnectionCreateView.vue'),
                },
                {
                    path     : "/connections/:id/authorize",
                    name     : routesName.connection_authorize,
                    component: () => import('@/views/connection/ConnectionAuthorizeView.vue'),
                }
            ],
        },
    ]
})

export default router
