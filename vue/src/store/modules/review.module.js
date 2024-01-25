/*
 *   store/modules/review.module.js
 */

// import the api endpoints
import {
  getUserReviews,
  getUserPostedReviews,
  getProfileReviews
} from "@/services/review.api";

const state = {
  userreviews: [],
  userpostedreviews: [],
  profilereviews: []
};

const getters = {
  // care - name
  getUserReviews(state) {
    return state.userreviews;
  },
  getUserPostedReviews(state) {
    return state.userpostedreviews;
  },
  getProfileReviews(state) {
    return state.profilereviews;
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
  },
  async fetchUserPostedReviews({ commit }, url) {
    try {
      const response = await getUserPostedReviews(url);
      //console.log(response);
      commit("SET_USER_POSTED_REVIEWS", response.data);
    } catch (error) {
      // handle the error here
      console.log(error);
    }
  },
  async fetchProfileReviews({ commit }, url) {
    try {
      const response = await getProfileReviews(url);
      //console.log(response);
      commit("SET_PROFILE_REVIEWS", response.data);
    } catch (error) {
      // handle the error here
      console.log(error);
    }
  }
};

const mutations = {
  SET_USER_REVIEWS(state, data) {
    state.userreviews = data;
  },
  SET_USER_POSTED_REVIEWS(state, data) {
    state.userpostedreviews = data;
  },
  SET_PROFILE_REVIEWS(state, data) {
    state.profilereviews = data;
  }
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
};
