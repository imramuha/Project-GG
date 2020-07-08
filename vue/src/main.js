import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store/store";
import httpClient from "@/services/httpClient";
import axios from "axios";

import "@fortawesome/fontawesome-free/css/all.css";
import "@fortawesome/fontawesome-free/js/all.js";

import moment from "moment";

Vue.filter("formatDateTime", function(value) {
    if (value) {
        return moment(String(value)).format("MM/DD/YYYY - hh:mm");
    }
});


Vue.filter("formatDate", function(value) {
    if (value) {
        return moment(String(value)).format("MM/DD/YYYY");
    }
});


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

            this.$store.commit("ACTIVATE_PUSHER", userData); // restore user data with Vuex
            this.$store.commit("USER_ONLINE");

            window.addEventListener("beforeunload", this.handler);
        }
        axios.interceptors.response.use(
            response => response, // simply return the response
            error => {
                /*if (error.response.status === 401) {
                                    // if we catch a 401 error
                                    this.$store.dispatch("logout"); // force a log out
                                } */
                return Promise.reject(error); // reject the Promise, with the error as the reason
            }
        );
        // created after user logs in
        window.addEventListener("beforeunload", this.handler);
    },
    beforeDestroy() {
        window.removeEventListener("beforeunload", this.handler);
    },
    methods: {
        handler(event) {
            event.preventDefault();
            event.returnValue = "string";
            /*const authenticated = localStorage.getItem("user");

                  console.log(authenticated);

                  if (authenticated) {
                      this.$store.commit("USER_ONLINE");
                  } else {
                      this.$store.commit("USER_OFFLINE");
                  } 
                  const reload = performance.getEntriesByType("navigation");
                  console.log(reload); *
                  */

            // find a way to do it with the confirmation

            /*localStorage.removeItem("user");
                  this.$store.commit("USER_OFFLINE")
                  location.reload(); */
        }
    },
    render: h => h(App)
}).$mount("#app");