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
                    path    : "/projects",
                    children: [
                        {
                            path     : "",
                            name     : routesName.projects,
                            component: () => import('@/views/projects/ProjectsView.vue'),
                        },
                        {
                            path     : ":id",
                            name     : routesName.project_overview,
                            component: () => import('@/views/projects/ProjectOverview.vue'),
                        },
                    ],
                },

                {
                    path    : "/connections",
                    children: [
                        {
                            path     : "create",
                            name     : routesName.connection_create,
                            component: () => import('@/views/connection/ConnectionCreateView.vue'),
                        }
                    ],
                },
            ],
        },
    ]
})

export default router
