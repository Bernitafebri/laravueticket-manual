import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        // component: () => imxport("./Pages/Login.vue"),
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
