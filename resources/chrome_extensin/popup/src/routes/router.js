import {createRouter, createWebHashHistory} from 'vue-router'

const routes = [
    {
        path     : '/',
        name     :  "home",
        component: () => import('@/views/home/HomeView.vue'),
        redirect : {name: "snippets.list"}
    },
    {
        path     : '/snippets',
        name     :  "snippets.list",
        component: () => import('@/views/snippets/SnippetsListView.vue'),
    },
    {
        path     : '/snippets/use/:id',
        name     :  "snippets.use",
        component: () => import('@/views/use-snippet/UseSnippetView.vue'),
    }
]

const index = createRouter({
    history: createWebHashHistory(process.env.BASE_URL),
    routes,
})

export default index
