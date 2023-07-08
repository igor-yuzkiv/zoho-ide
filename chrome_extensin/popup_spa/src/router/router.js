import {createRouter, createWebHashHistory} from 'vue-router'

const routes = [
    {
        path     : '',
        name     : "Home",
        component: () => import(/* webpackChunkName: "home" */ '../views/HomeView.vue'),
    }
]

const index = createRouter({
    history: createWebHashHistory(process.env.BASE_URL),
    routes,
})

export default index
