import httpClient from "./httpClient";

const END_POINT = "/api/frontend/conversation/";


const getConversation = id => httpClient.get(END_POINT + id);


export { getConversation };