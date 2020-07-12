import httpClient from "./httpClient";

//const PROFILE_REVIEWS_END_POINT = "/api/frontend/profilereviews/";

const getUserReviews = url => httpClient.get(url);
const getUserPostedReviews = url => httpClient.get(url);

const getProfileReviews = url => httpClient.get(url);

export { getUserReviews, getUserPostedReviews, getProfileReviews };