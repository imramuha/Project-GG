import httpClient from "./httpClient";

const END_POINT = "/api/frontend/posts";
//const USER_END_POINT = "/api/frontend/userposts";
const COMMENT_END_POINT = "/api/frontend/post/comment";

const CREATE_END_POINT = "/api/frontend/post/create";

const LIKE_POST_END_POINT = "/api/frontend/postlike";

const getAllPosts = () => httpClient.get(END_POINT);

const getUserPosts = url => httpClient.get(url);

const POST_END_POINT = "/api/frontend/post/";

const getPost = id => httpClient.get(POST_END_POINT + id);

const postComment = data => httpClient.post(COMMENT_END_POINT, data);

const createPost = (data, config) =>
    httpClient.post(CREATE_END_POINT, data, config);

const likePost = data => httpClient.post(LIKE_POST_END_POINT, data);

// you can pass arguments to use as request parameters/data
// const getUser = (user_id) => httpClient.get(END_POINT, { user_id });
// maybe more than one..
// const createUser = (username, password) => httpClient.post(END_POINT, { username, password });

export {
    getAllPosts,
    getUserPosts,
    getPost,
    postComment,
    createPost,
    likePost
};