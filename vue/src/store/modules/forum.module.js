/*
 *   store/modules/posts.module.js
 */

// import the api endpoints
import {
    getNewPosts,
    getTopPosts,
    getLikedPosts,
    getUserPosts
} from "@/services/forum.api";

const state = {
    newposts: [],
    topposts: [],
    likedposts: [],
    userposts: []
};

const getters = {
    getNewPosts(state) {
        return state.newposts;
    },
    getTopPosts(state) {
        return state.topposts;
    },
    getLikedPosts(state) {
        return state.likedposts;
    },
    getUserPosts(state) {
        return state.userposts;
    }
};

const actions = {
    async fetchNewPosts({ commit }, url) {
        try {
            const response = await getNewPosts(url);
            console.log(response);
            commit("SET_NEW_POSTS", response.data);
        } catch (error) {
            // handle the error here
            console.log(error);
        }
    },
    async fetchTopPosts({ commit }, url) {
        try {
            const response = await getTopPosts(url);
            console.log(response);
            commit("SET_TOP_POSTS", response.data);
        } catch (error) {
            // handle the error here
            console.log(error);
        }
    },
    async fetchLikedPosts({ commit }, url) {
        try {
            const response = await getLikedPosts(url);
            console.log(response);
            commit("SET_LIKED_POSTS", response.data);
        } catch (error) {
            console.log(error);
        }
    },
    async fetchUserPosts({ commit }, url) {
        try {
            const response = await getUserPosts(url);
            console.log(response);
            commit("SET_USER_POSTS", response.data);
        } catch (error) {
            // handle the error here
            console.log(error);
        }
    }
};

const mutations = {
    SET_NEW_POSTS(state, data) {
        state.newposts = data;
    },
    SET_TOP_POSTS(state, data) {
        state.topposts = data;
    },
    SET_LIKED_POSTS(state, data) {
        state.likedposts = data;
    },
    SET_USER_POSTS(state, data) {
        state.userposts = data;
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};