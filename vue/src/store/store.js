import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";
import httpClient from "@/services/httpClient";

import Forum from "@/store/modules/forum.module";
import Game from "@/store/modules/game.module";
import Review from "@/store/modules/review.module";

Vue.use(Vuex);

import Pusher from "pusher-js";

const api = process.env.VUE_APP_BASE_URL;

export default new Vuex.Store({
    state: {
        user: null,
        errors: [],
        notifications: [],
        historyNotifications: [],
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

            const today = new Date();
            const time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
            message.time = time;

            console.log(state.historyNotifications.length);

            // once ut gets over 10 items -> delete the lowest index
            if (state.historyNotifications.length >= 10) {
                state.historyNotifications.shift();
            }

            if (state.notifications) {
                state.notifications.push(message);
                state.historyNotifications.push(message);
            } else {
                state.notifications = message;
                state.historyNotifications = message;
            }
        },
        REMOVE_NOTIFICATION(state, index) {
            state.notifications.splice(index, 1);
        },
        USER_ONLINE(state) {
            let online = {
                token: state.user.token,
                status: "online"
            };

            axios
                .post(api + "/api/frontend/userstatus", online)
                .then(({ data }) => {
                    console.log(data);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        USER_OFFLINE(state) {
            let offline = {
                token: state.user.token,
                status: "offline"
            };

            axios
                .post(api + "/api/frontend/userstatus", offline)
                .then(({ data }) => {
                    console.log(data);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        LOGOUT() {
            // change user stats to offline through pusher
            // global pusher */
            // forced refresh
            localStorage.removeItem("user");
        },
        ACTIVATE_PUSHER(userData) {
            Pusher.logToConsole = true;

            console.log("pusher");

            window.pusher = new Pusher("c8af74134473385784fa", {
                authEndpoint: api + "/api/frontend/pusher/auth",
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
                    .post(api + "/api/auth/register", credentials)
                    .then(({ data }) => {
                        resolve(
                            commit("SET_USER_DATA", data.token),
                            commit("ACTIVATE_PUSHER")
                        );
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
                    .post(api + "/api/auth/login", credentials)
                    .then(({ data }) => {
                        resolve(
                            commit("SET_USER_DATA", data.token),
                            commit("USER_ONLINE"),
                            commit("ACTIVATE_PUSHER")
                        );
                    })
                    .catch(error => {
                        reject(error.response.data.errors);
                    });
            });
        },
        notification({ commit }, message) {
            return commit("SET_NOTIFICATIONS", message);
        },
        removeNotification({ commit }, index) {
            commit("REMOVE_NOTIFICATION", index);
        },
        logout({ commit }) {
            commit("LOGOUT");
            commit("USER_OFFLINE");
        }
    },
    getters: {
        loggedIn(state) {
            return !!state.user;
        },
        getNotifications(state) {
            return state.notifications;
        },
        getHistoryNotifications(state) {
            return state.historyNotifications;
        }
    },
    modules: {
        Forum,
        Game,
        Review
    }
});