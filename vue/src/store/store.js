import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";

import Forum from "@/store/modules/forum.module";
import Game from "@/store/modules/game.module";
import Review from "@/store/modules/review.module";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        user: null
    },
    mutations: {
        SET_USER_DATA(state, userData) {
            state.user = userData;
            localStorage.setItem("user", JSON.stringify(userData));
            axios.defaults.headers.common[
                "Authorization"
            ] = `Bearer ${userData.token}`;
        },
        LOGOUT() {
            localStorage.removeItem("user");
            // forced refresh
            location.reload();
        }
    },
    actions: {
        register({ commit }, credentials) {
            return axios
                .post("http://127.0.0.1:8000/api/auth/register", credentials)
                .then(({ data }) => {
                    console.log("user data is", data);
                    commit("SET_USER_DATA", data);
                });
        },
        login({ commit }, credentials) {
            return axios
                .post("http://127.0.0.1:8000/api/auth/login", credentials)
                .then(({ data }) => {
                    commit("SET_USER_DATA", data);
                });
        },
        logout({ commit }) {
            commit("LOGOUT");
        }
    },
    getters: {
        loggedIn(state) {
            return !!state.user;
        }
    },
    modules: {
        Forum,
        Game,
        Review
    }
});