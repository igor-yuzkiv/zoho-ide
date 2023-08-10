import {createRouter, createWebHashHistory} from 'vue-router'
import routesName                           from "@/constans/routesName.js";

import DefaultLayout from "@/layout/DefaultLayout.vue";

const routes = [
    {
        path     : "/",
        component: DefaultLayout,
        children: [
            {
                path     : '',
                name     :  routesName.home,
                component: () => import('@/views/HomeView.vue'),
            }
        ]
    }
]

const index = createRouter({
    history: createWebHashHistory(process.env.BASE_URL),
    routes,
})

export default index
