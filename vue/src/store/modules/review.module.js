/*
 *   store/modules/review.module.js
 */

// import the api endpoints
import { getUserReviews } from "@/services/review.api";

const state = {
    userreviews: [],
};

const getters = {
    // care - name
    getUserReviews(state) {
        return state.userreviews;
    }
};

const actions = {
    async fetchUserReviews({ commit }, url) {
        try {
            const response = await getUserReviews(url);
            //console.log(response);
            commit("SET_USER_REVIEWS", response.data);
        } catch (error) {
            // handle the error here
            console.log(error);
        }
    }
};

const mutations = {
    SET_USER_REVIEWS(state, data) {
        state.userreviews = data;
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};