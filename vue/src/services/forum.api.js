import httpClient from "./httpClient";

const COMMENT_END_POINT = "/api/frontend/post/comment";
const CREATE_END_POINT = "/api/frontend/post/create";
const LIKE_POST_END_POINT = "/api/frontend/postlike";
const POST_END_POINT = "/api/frontend/post/";
const NEWS_END_POINT = "/api/frontend/news";

const getUserPosts = url => httpClient.get(url);
const getPost = id => httpClient.get(POST_END_POINT + id);
const postComment = data => httpClient.post(COMMENT_END_POINT, data);
const createPost = (data, config) => httpClient.post(CREATE_END_POINT, data, config);
const likePost = data => httpClient.post(LIKE_POST_END_POINT, data);

/*
 * FORUM
 */
const getNewPosts = url => httpClient.get(url);
const getTopPosts = url => httpClient.get(url);
const getLikedPosts = url => httpClient.get(url);

const getNews = () => httpClient.get(NEWS_END_POINT);

export {
    getUserPosts,
    getNewPosts,
    getTopPosts,
    getLikedPosts,
    getPost,
    postComment,
    createPost,
    likePost,
    getNews
};