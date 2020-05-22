import httpClient from "./httpClient";

// const USER_END_POINT = "/api/frontend/usergames";

const getUserReviews = url => httpClient.get(url);

export { getUserReviews };