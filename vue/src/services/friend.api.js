import httpClient from "./httpClient";

const END_POINT = "/api/frontend/friends";

const FRIEND_END_POINT = "/api/frontend/user/";

const REVIEW_END_POINT = "/api/frontend/user/review";
const RELATION_END_POINT = "/api/frontend/relation/";

const getAllFriends = () => httpClient.get(END_POINT);

const getFriend = id => httpClient.get(FRIEND_END_POINT + id);
const getRelation = id => httpClient.get(RELATION_END_POINT + id);


const reviewUser = data => httpClient.post(REVIEW_END_POINT, data);

// console.log(httpClient.get('user'+END_POINT));

export { getAllFriends, getFriend, reviewUser, getRelation };