import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store/store";
import httpClient from "./services/httpClient";
//import pusher from "./services/pusher";
import axios from "axios";

import '@fortawesome/fontawesome-free/css/all.css'
import '@fortawesome/fontawesome-free/js/all.js'
// TEMP
/*

import VueEcho from 'vue-echo';
Vue.use(VueEcho, {
    authEndpoint: 'http://127.0.0.1:8000/api/broadcasting/auth',
    broadcaster: 'pusher',
    key: 'c8af74134473385784fa',
    cluster: 'eu',
    forceTLS: true,
    encrypted: true,
    auth: {
        headers: {
            Authorization: `Bearer ${user.token}`,

        }
    },
}) 
import Echo from "laravel-echo"
import Pusher from "pusher-js"


window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'c8af74134473385784fa',
    cluster: 'eu',
    forceTLS: true,
    encrypted: true,
    auth: {
        headers: {
            Authorization: `Bearer ${user.token}`,

        }
    },
});

window.Pusher = require('pusher-js');

Pusher.log = function(message) {
    window.console.log(message)
}; *
*/

Vue.config.productionTip = false;

new Vue({
    router,
    store,
    httpClient,
    created() {
        const userString = localStorage.getItem("user"); // grab user data from local storage
        if (userString) {
            // check to see if there is indeed a user
            const userData = JSON.parse(userString); // parse user data into JSON
            this.$store.commit("SET_USER_DATA", userData); // restore user data with Vuex

            console.log(userData)

            this.$store.commit("ACTIVATE_PUSHER", userData); // restore user data with Vuex
        }
        axios.interceptors.response.use(
            response => response, // simply return the response
            error => {
                if (error.response.status === 401) {
                    // if we catch a 401 error
                    this.$store.dispatch("logout"); // force a log out
                }
                return Promise.reject(error); // reject the Promise, with the error as the reason
            }
        );
    },
    render: h => h(App)
}).$mount("#app");