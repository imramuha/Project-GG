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
        historyNotifications: []
    },
    mutations: {
        // sets user data in localstorage and also assigns the user headers
        SET_USER_DATA(state, userData) {
            state.user = userData;

            localStorage.setItem("user", JSON.stringify(userData));

            const authInterceptor = config => {
                config.headers["Authorization"] = `Bearer ${state.user.token}`;
                return config;
            };

            httpClient.interceptors.request.use(authInterceptor);
        },
        // sets notification and pushes to the array
        SET_NOTIFICATIONS(state, message) {
            const today = new Date();

            function addZeroBefore(n) {
                return (n < 10 ? "0" : "") + n;
            }

            const hours = addZeroBefore(today.getHours());
            const minutes = addZeroBefore(today.getMinutes());
            const seconds = addZeroBefore(today.getSeconds());

            const time = hours + ":" + minutes + ":" + seconds;
            message.time = time;

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
        // removes the oldest notification from the array of notifcations
        REMOVE_NOTIFICATION(state, index) {
            state.notifications.splice(index, 1);
        },
        // changes the user to online
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
        // changes the user status to offline
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
        // logs user out and reassigns the headers
        LOGOUT(state) {
            axios
                .post(api + "/api/auth/logout", state.user)
                .then(({ data }) => {
                    console.log(data);
                    localStorage.removeItem("user");
                    state.user = null;

                    const authInterceptor = config => {
                        config.headers["Authorization"] = `Bearer ${state.user.token}`;
                        return config;
                    };

                    httpClient.interceptors.request.use(authInterceptor);
                })
                .catch(error => {
                    console.log(error);
                });
        },
        // activates the pusher/real time tech
        ACTIVATE_PUSHER(userData) {
            Pusher.logToConsole = true;

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
                            console.log(data.token),
                            commit("SET_USER_DATA", data.token),
                            commit("USER_ONLINE"),
                            commit("ACTIVATE_PUSHER")
                        );
                    })
                    .catch(error => {
                        reject(error);
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
            commit("USER_OFFLINE");
            commit("LOGOUT");
        }
    },
    getters: {
        loggedIn(state) {
            return state.user;
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