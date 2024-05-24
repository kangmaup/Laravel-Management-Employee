import { createRouter, createWebHistory } from "vue-router";

import Dashboard from "../pages/dashboard/index.vue";
import Employees from "../pages/dashboard/employees.vue";
import Positions from "../pages/dashboard/positions.vue";
import Workplace from "../pages/dashboard/workplace.vue";
import Roles from "../pages/dashboard/role.vue";
import Permissions from "../pages/dashboard/permission.vue";
import register from "../pages/auths/register/index.vue";
import login from "../pages/auths/login/index.vue";

const routes = [
    {
        path: "/",
        component: Dashboard,
    },
    {
        path: "/register",
        component: register,
    },
    {
        path: "/login",
        component: login,
    },
    {
        path: "/dashboard",
        component: Dashboard,
    },
    {   path: "/employees",
        component: Employees
    },
    {   path: "/positions",
        component: Positions
    },
    {   path: "/workplace",
        component: Workplace
    },
    {   path: "/roles",
        component: Roles
    },
    {   path: "/permissions",
        component: Permissions
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});


export default router;
