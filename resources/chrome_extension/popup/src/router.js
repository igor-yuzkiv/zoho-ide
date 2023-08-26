import {createRouter, createWebHashHistory} from 'vue-router'
import routesName from "@/constans/routesName.js";

const routes = [
    {
        path     : '/',
        name     : routesName.home,
        component: () => import('@/views/home/HomeView.vue'),
        redirect : {name: routesName.snippets}
    },
    {
        path     : '/snippets',
        name     : routesName.snippets,
        component: () => import('@/views/snippets/SnippetsListView.vue'),
    },
    {
        path     : '/snippets/use/:id',
        name     : routesName.use_snippet,
        component: () => import('@/views/snippets/use/UseSnippetView.vue'),
    },
    {
        path     : '/settings',
        name     : routesName.settings,
        component: () => import('@/views/settings/SettingsView.vue'),
    }
]

const index = createRouter({
    history: createWebHashHistory(process.env.BASE_URL),
    routes,
})

export default index
