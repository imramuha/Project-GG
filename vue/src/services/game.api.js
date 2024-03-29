import httpClient from "./httpClient";

const REMOVE_USER_GAME_END_POINT = "/api/frontend/removeusergame";
const UNADDED_USER_GAMES_END_POINT = "/api/frontend/usergamesunadded";
const ADD_USER_GAME_END_POINT = "/api/frontend/addusergame";

const getUserGames = url => httpClient.get(url);

const removeUserGame = id => httpClient.post(REMOVE_USER_GAME_END_POINT, id);

const getUserGamesUnadded = () => httpClient.get(UNADDED_USER_GAMES_END_POINT);

const addUserGame = data => httpClient.post(ADD_USER_GAME_END_POINT, data);

const getProfileGames = url => httpClient.get(url);

export {
  getUserGames,
  removeUserGame,
  getUserGamesUnadded,
  addUserGame,
  getProfileGames
};
