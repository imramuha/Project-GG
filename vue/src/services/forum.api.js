import httpClient from "./httpClient";

const END_POINT = "/api/frontend/posts";

const getAllPosts = () => httpClient.get(END_POINT);

// you can pass arguments to use as request parameters/data
// const getUser = (user_id) => httpClient.get(END_POINT, { user_id });
// maybe more than one..
// const createUser = (username, password) => httpClient.post(END_POINT, { username, password });

export {
  getAllPosts
  //getUser,
  //createUser
};
