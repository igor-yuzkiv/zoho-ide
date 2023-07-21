import {
    createRouter,
    createWebHistory
} from 'vue-router'

import * as routesName from "@/constans/routes.js";

import DefaultLayout from "@/layout/default/DefaultLayout.vue";

const router = createRouter({
    history: createWebHistory(import.meta.env.VITE_APP_BASE_WEB_URI),
    routes: [
        {
            path: "/",
            component: DefaultLayout,
            children: [
                {
                    path: '/',
                    name: routesName.HOME_ROUTE,
                    component: () => import('@/views/home/HomeView.vue'),
                },

                {
                    path: '/projects',
                    name: routesName.PROJECTS_ROUTE,
                    component: () => import('@/views/project/ProjectsListView.vue'),
                },
                {
                    path: '/projects/:id',
                    name: routesName.PROJECT_EDIT_ROUTE,
                    component: () => import('@/views/project/ProjectEditView.vue'),
                }
            ],
        },
    ]
})

export default router
