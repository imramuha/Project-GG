import Vue from "vue";
import Router from 'vue-router'
import Home from "../views/Home.vue";
import Login from "../views/Login.vue";
import Dashboard from "../views/Dashboard.vue";

import WaitingRoom from "../views/WaitingRoom.vue";
import Profile from "../views/Profile.vue";

import store from '@/store';

Vue.use(Router);


export default new Router({
  mode: "history",
  routes: [{
    path: "/",
    name: "home",
    component: Home
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
  },
  {
    path: "/dashboard",
    name: "dashboard",
    component: Dashboard,
    beforeEnter: (to, from, next) => {
      if (!store.getters['auth/authenticated']) {
        return next({
          name: 'login'
        })
      }
      next();
    }
  }],
});

/* 
ADD A 404 PAGE -> check out the documentation (history mode^)
*/