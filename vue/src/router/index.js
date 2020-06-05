import Vue from "vue";
import Router from "vue-router";
import Home from "../views/Home.vue";

import Dashboard from "../views/Dashboard.vue";
import Forum from "../views/Forum.vue";
import Post from "../views/Post.vue";
import PostInput from "../views/PostInput.vue";
// forumpost

import Register from "../views/Register.vue";
import Login from "../views/Login.vue";

import Profile from "../views/Profile.vue";
import User from "../views/User.vue";
import UserEdit from "../views/UserEdit.vue";

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
            path: "/forum",
            name: "forum",
            component: Forum,
            meta: { requiresAuth: true }
        },
        {
            path: "/register",
            name: "register",
            component: Register
        },
        {
            path: "/login",
            name: "login",
            component: Login
        },
        {
            path: "/user",
            name: "user",
            component: User,
            props: true
        },
        {
            path: "/useredit",
            name: "useredit",
            component: UserEdit,
            props: true
        }, {
            path: "/profile/:id",
            name: "profile",
            component: Profile,
            props: true
        },
        {
            path: "/post/:id",
            name: "post",
            component: Post,
            props: true
        },
        {
            path: "/postcreate",
            name: "postcreate",
            component: PostInput,
            props: true
        }

    ]
});

// if our route authentication and is not loged in we need to redirect them to home
router.beforeEach((to, from, next) => {
    const loggedIn = localStorage.getItem("user");
    if (to.matched.some(record => record.meta.requiresAuth) && !loggedIn) {
        next("/");
    }
    next();
});

/* 
ADD A 404 PAGE -> check out the documentation (history mode^)
*/

export default router;