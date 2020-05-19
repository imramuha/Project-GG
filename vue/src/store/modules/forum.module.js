/*
 *   store/modules/posts.module.js
 */

// import the api endpoints
import { getAllPosts, getUserPosts } from "@/services/forum.api";

const state = {
  posts: [],
  userposts: []
};

const getters = {
  getPosts(state) {
    return state.posts;
  },
  // care - name
  getUserPosts(state) {
    return state.userposts;
  }
};

const actions = {
  async fetchPosts({ commit }) {
    try {
      const response = await getAllPosts();
      console.log(response);
      commit("SET_POSTS", response.data);
    } catch (error) {
      // handle the error here
      console.log(error);
    }
  },
  async fetchUserPosts({ commit }) {
    try {
      const response = await getUserPosts();
      console.log(response);
      commit("SET_USER_POSTS", response.data);
    } catch (error) {
      // handle the error here
      console.log(error);
    }
  }
};

const mutations = {
  SET_POSTS(state, data) {
    state.posts = data;
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
