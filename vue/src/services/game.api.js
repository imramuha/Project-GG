import httpClient from "./httpClient";

// const USER_END_POINT = "/api/frontend/usergames";

const getUserGames = url => httpClient.get(url);


export { getUserGames };