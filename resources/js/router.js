import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        component: () => import("./Pages/Auth/Login.vue"),
    },
    {
        path: "/home",
        component: () => import("./Pages/Home.vue"),
    },
    {
        path: "/test",
        component: () => import("./Pages/Test.vue"),
    },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
