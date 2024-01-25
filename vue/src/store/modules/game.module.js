/*
 *   store/modules/games.module.js
 */

// import the api endpoints
import { getUserGames } from "@/services/game.api";
import { getProfileGames } from "@/services/game.api";

const state = {
  usergames: [],
  profilegames: []
};

const getters = {
  // care - name
  getUserGames(state) {
    return state.usergames;
  },
  getProfileGames(state) {
    return state.profilegames;
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
  },
  async fetchProfileGames({ commit }, url) {
    try {
      const response = await getProfileGames(url);
      //console.log(response);
      commit("SET_PROFILE_GAMES", response.data);
    } catch (error) {
      // handle the error here
      console.log(error);
    }
  }
};

const mutations = {
  SET_USER_GAMES(state, data) {
    state.usergames = data;
  },
  SET_PROFILE_GAMES(state, data) {
    state.profilegames = data;
  }
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
};
