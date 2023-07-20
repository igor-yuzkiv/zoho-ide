import {
    createRouter,
    createWebHistory
} from 'vue-router'

import * as routesName from "@/constans/routes.js";

const router = createRouter({
    history: createWebHistory(import.meta.env.VITE_APP_BASE_WEB_URI),
    routes: [
        {
            path: "/",
            component: () => import("@/layout/default/DefaultLayout.vue"),
            children: [
                {
                    path: '/',
                    name: routesName.HOME_ROUTE,
                    component: () => import('@/views/HomeView.vue'),
                },

                {
                    path: '/projects',
                    name: routesName.PROJECTS_ROUTE,
                    component: () => import('@/views/project/ProjectsView.vue'),
                },
                {
                    path: '/projects/:id',
                    name: routesName.PROJECT_EDIT_ROUTE,
                    component: () => import('@/views/project/ProjectEdit.vue'),
                }
            ],
        },
    ]
})

export default router
