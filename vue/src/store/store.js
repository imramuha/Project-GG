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
        user: null,
        errors: [],
        notifications: [],
    },
    mutations: {
        SET_USER_DATA(state, userData) {
            state.user = userData;

            localStorage.setItem("user", JSON.stringify(userData));

            const authInterceptor = config => {
                config.headers["Authorization"] = `Bearer ${userData.token}`;
                return config;
            };

            httpClient.interceptors.request.use(authInterceptor);
        },
        SET_NOTIFICATIONS(state, message) {
            if (state.notifications) {
                state.notifications.push(message)
            } else {
                state.notifications = message;
            }
        },
        REMOVE_NOTIFICATION(state, index) {
            console.log(state.notifications);
            console.log(index);
            state.notifications.splice(index, 1);
            //state.notifications.$delete(notification)
        },
        LOGOUT() {
            localStorage.removeItem("user");
            // forced refresh
            location.reload();
        },
        ACTIVATE_PUSHER(userData) {
            Pusher.logToConsole = true;

            console.log("pusher");

            window.pusher = new Pusher("c8af74134473385784fa", {
                authEndpoint: "http://127.0.0.1:8000/api/frontend/messaging/auth",
                cluster: "eu",
                auth: {
                    headers: {
                        Authorization: `Bearer ${userData.user.token}`
                    }
                }
            });
        }
    },
    actions: {
        register({ commit }, credentials) {
            return new Promise((resolve, reject) => {
                axios
                    .post("http://127.0.0.1:8000/api/auth/register", credentials)
                    .then(({ data }) => {
                        resolve(commit("SET_USER_DATA", data.token));
                    })
                    .catch(error => {
                        console.log(error);
                        reject(error.response.data.errors);
                    });
            });
        },
        login({ commit }, credentials) {
            return new Promise((resolve, reject) => {
                axios
                    .post("http://127.0.0.1:8000/api/auth/login", credentials)
                    .then(({ data }) => {
                        resolve(commit("SET_USER_DATA", data.token));
                    })
                    .catch(error => {
                        reject(error.response.data.errors);
                    });
            });
        },
        notification({ commit }, message) {
            return commit("SET_NOTIFICATIONS", message)

        },
        removeNotification({ commit }, index) {
            commit('REMOVE_NOTIFICATION', index);
        },
        logout({ commit }) {
            commit("LOGOUT");
        }
    },
    getters: {
        loggedIn(state) {
            return !!state.user;
        },
        getNotifications(state) {
            return state.notifications;
        }
    },
    modules: {
        Forum,
        Game,
        Review
    }
});