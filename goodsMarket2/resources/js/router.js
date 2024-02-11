import { createWebHistory, createRouter } from 'vue-router';
import MainComponent from '../components/MainComponent.vue';
import MypageComponent from '../components/MypageComponent.vue';


const routes = [
    {
        path: '/',
        redirect: '/main',
    },
    {
        path: '/main',
        component: MainComponent,
    },
    {
        path: '/mypage',
        component: MypageComponent,
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;