import httpClient from "./httpClient";

const END_POINT = "/api/frontend/queuegames";

const getQueueGames = () => httpClient.get(END_POINT);

export { getQueueGames };