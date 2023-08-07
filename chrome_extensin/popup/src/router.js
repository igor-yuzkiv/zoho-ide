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
                component: () => import('@/views/SnippetsListView.vue'),
            },
            {
                path     : 'snippet',
                name     :  routesName.snippet_view,
                component: () => import('@/views/snippet/SnippetView.vue'),
            },
            {
                path     : 'apps-meta',
                name     :  routesName.apps_meta,
                component: () => import('@/views/apps-meta/AppsMetaView.vue'),
            },
            {
                path     : 'test',
                name     :  routesName.test,
                component: () => import('@/views/TestView.vue'),
            },
        ]
    }
]

const index = createRouter({
    history: createWebHashHistory(process.env.BASE_URL),
    routes,
})

export default index
