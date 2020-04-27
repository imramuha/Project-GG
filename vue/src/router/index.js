import Vue from "vue";
import Router from 'vue-router'
import Home from "../views/Home.vue";
import Login from "../views/Login.vue";
import Dashboard from "../views/Dashboard.vue";

import Register from "../views/Register.vue";

import WaitingRoom from "../views/WaitingRoom.vue";
import Profile from "../views/Profile.vue";

Vue.use(Router);


export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [ {
    path: '/',
    name: 'home',
    component: Home
  },
  {
    path: '/dashboard',
    name: 'dashboard',
    component: Dashboard
  },
  {
    path: "/register",
    name: "register",
    component: Register
  },
  {
    path: "/waitingroom",
    name: "waiting-room",
    component: WaitingRoom
    
  },
  {
    path: "/profile/:id",
    name: "profile",
    component: Profile,
    props: true,
  },
  {
    path: "/login",
    name: "login",
    component: Login
  }],
});

/* 
ADD A 404 PAGE -> check out the documentation (history mode^)
*/