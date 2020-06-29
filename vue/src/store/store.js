import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";
import httpClient from "@/services/httpClient";

import Forum from "@/store/modules/forum.module";
import Game from "@/store/modules/game.module";
import Review from "@/store/modules/review.module";

Vue.use(Vuex);

import Pusher from "pusher-js";

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
        },
        ACTIVATE_PUSHER(userData) {
            Pusher.logToConsole = true;

            console.log('pusher')

            window.pusher = new Pusher('c8af74134473385784fa', {
                authEndpoint: 'http://127.0.0.1:8000/api/frontend/messaging/auth',
                cluster: 'eu',
                auth: {
                    headers: {
                        Authorization: `Bearer ${userData.user.token}`,
                    }
                },
            });
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
                    console.log(data.token);

                    console.log('02315646548987');

                    // set the headers for our httpshelper
                    const authInterceptor = config => {
                        config.headers["Authorization"] = `Bearer ${data.token}`;
                        return config;
                    };

                    httpClient.interceptors.request.use(authInterceptor);
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