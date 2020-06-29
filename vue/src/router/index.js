import Vue from "vue";
import Router from "vue-router";
import Home from "../views/Home.vue";

import Dashboard from "../views/Dashboard.vue";

import Register from "../views/Register.vue";
import Login from "../views/Login.vue";

Vue.use(Router);

const router = new Router({
    mode: "history",
    base: process.env.BASE_URL,
    routes: [{
            path: "/",
            name: "home",
            component: Home
        },
        {
            path: "/dashboard",
            name: "dashboard",
            component: Dashboard,
            meta: { requiresAuth: true }
        },
        {
            path: "/register",
            name: "register",
            component: Register,
            meta: {
                hideForAuth: true
            }
        },
        {
            path: "/login",
            name: "login",
            component: Login,
            meta: {
                hideForAuth: true
            }
        }
    ]
});

// if our route authentication and is not logged in we need to redirect them to home
router.beforeEach((to, from, next) => {
    const loggedIn = localStorage.getItem("user");

    if (to.matched.some(record => record.meta.requiresAuth) && !loggedIn) {
        next("/");
    } else {
        next();
    }

    if (to.matched.some(record => record.meta.hideForAuth)) {
        if (loggedIn) {
            next({ path: '/dashboard' });
        } else {
            next();
        }
    } else {
        next();
    }
});


/* 
ADD A 404 PAGE -> check out the documentation (history mode^)
*/

export default router;