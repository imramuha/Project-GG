
import httpClient from "./httpClient";

const END_POINT = "/api/frontend/friends";
const FRIEND_END_POINT = "/api/frontend/user/";

const getAllFriends = () => httpClient.get(END_POINT);

const getFriend = (id) => httpClient.get(FRIEND_END_POINT + id);

// console.log(httpClient.get('user'+END_POINT));

export {
  getAllFriends,
  getFriend
};
