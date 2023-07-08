import {
    createRouter,
    createWebHistory
} from 'vue-router'

const router = createRouter({
    history: createWebHistory(import.meta.env.VITE_APP_BASE_WEB_URI),
    routes: [
        {
            path: '/',
            name: 'HOME',
            component: () => import('@/views/HomeView.vue'),
        }
    ]
})

export default router
