import httpClient from "./httpClient";

const NEW_POSTS_END_POINT = "/api/frontend/postsnew";
const TOP_POSTS_END_POINT = "/api/frontend/poststop";
const LIKED_POSTS_END_POINT = "/api/frontend/postsliked";
const COMMENT_END_POINT = "/api/frontend/post/comment";
const CREATE_END_POINT = "/api/frontend/post/create";
const LIKE_POST_END_POINT = "/api/frontend/postlike";
const POST_END_POINT = "/api/frontend/post/";
const NEWS_END_POINT = "/api/frontend/news";

const getUserPosts = url => httpClient.get(url);
const getPost = id => httpClient.get(POST_END_POINT + id);
const postComment = data => httpClient.post(COMMENT_END_POINT, data);
const createPost = (data, config) =>
    httpClient.post(CREATE_END_POINT, data, config);
const likePost = data => httpClient.post(LIKE_POST_END_POINT, data);

/*
 * FORUM
 */
const getNewPosts = () => httpClient.get(NEW_POSTS_END_POINT);
const getTopPosts = () => httpClient.get(TOP_POSTS_END_POINT);
const getLikedPosts = () => httpClient.get(LIKED_POSTS_END_POINT);

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