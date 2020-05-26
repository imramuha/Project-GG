import httpClient from "./httpClient";

const END_POINT = "/api/frontend/conversation/";

const END_POINT_SEND = "/api/frontend/conversation/send";


const getConversation = id => httpClient.get(END_POINT + id);

const postMessage = data => httpClient.post(END_POINT_SEND, data);

export { getConversation, postMessage };