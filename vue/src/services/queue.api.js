import httpClient from "./httpClient";

const END_POINT = "/api/frontend/queuegames";
const QUEUE_END_POINT = "/api/frontend/queue";
const LOUNGE_END_POINT = "/api/frontend/lounge/";
const EXIT_LOUNGE_END_POINT = "/api/frontend/exitlounge";
const POST_GROUP_MESSAGE_POINT_SEND = "/api/frontend/groupmessage";

const getQueueGames = () => httpClient.get(END_POINT);
const queue = data => httpClient.post(QUEUE_END_POINT, data);
const getLoungeData = id => httpClient.get(LOUNGE_END_POINT + id);
const exitLounge = () => httpClient.get(EXIT_LOUNGE_END_POINT);
const postGroupMessage = data =>
  httpClient.post(POST_GROUP_MESSAGE_POINT_SEND, data);

export { getQueueGames, queue, getLoungeData, exitLounge, postGroupMessage };
