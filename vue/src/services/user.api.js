import httpClient from "./httpClient";

const END_POINT = "/api/frontend/user";
const EDIT_END_POINT = "/api/frontend/useredit";

const getMe = () => httpClient.get(END_POINT);

const editUser = data => httpClient.post(EDIT_END_POINT, data);

export { getMe, editUser };