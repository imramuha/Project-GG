import httpClient from "./httpClient";

const END_POINT = "/api/frontend/user";

const getMe = () => httpClient.get(END_POINT);

// console.log(httpClient.get('user'+END_POINT));

export { getMe };
