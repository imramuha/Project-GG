/*
 *   store/modules/games.module.js
 */

// import the api endpoints
import { getUserGames } from "@/services/game.api";

const state = {
  usergames: []
};

const getters = {
  // care - name
  getUserGames(state) {
    return state.usergames;
  }
};

const actions = {
  async fetchUserGames({ commit }, url) {
    try {
      const response = await getUserGames(url);
      //console.log(response);
      commit("SET_USER_GAMES", response.data);
    } catch (error) {
      // handle the error here
      console.log(error);
    }
  }
};

const mutations = {
  SET_USER_GAMES(state, data) {
    state.usergames = data;
  }
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
};
