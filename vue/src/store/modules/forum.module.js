/*
 *   store/modules/posts.module.js
 */

// import the api endpoints
import { getAllPosts } from "@/services/forum.api";

const state = {
  posts: []
};

const getters = {
  getPosts(state) {
    return state.posts;
  }
};

const actions = {
  async fetchPosts({ commit }) {
    try {
      const response = await getAllPosts();
      console.log(response)
      commit("SET_POSTS", response.data);
    } catch (error) {
      // handle the error here
      console.log(error);
    }
  }
};

const mutations = {
  SET_POSTS(state, data) {
    state.posts = data;
  }
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
};
