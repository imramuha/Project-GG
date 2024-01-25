import httpClient from "./httpClient";

const END_POINT = "/api/frontend/user";
const EDIT_END_POINT = "/api/frontend/useredit";

const SEARCH_END_POINT = "/api/frontend/searchusers";
const UPDATE_RELATION_END_POINT = "/api/frontend/updaterelation";

const USER_SETTINGS_END_POINT = "/api/frontend/usersettings";
const UPDATE_USER_SETTINGS_END_POINT = "/api/frontend/usersettingsedit";

const getUserSettings = () => httpClient.get(USER_SETTINGS_END_POINT);
const editUserSettings = data =>
  httpClient.post(UPDATE_USER_SETTINGS_END_POINT, data);

const getMe = () => httpClient.get(END_POINT);

const editUser = data => httpClient.post(EDIT_END_POINT, data);

const searchUsers = data => httpClient.post(SEARCH_END_POINT, data);

const updateRelation = data => httpClient.post(UPDATE_RELATION_END_POINT, data);
export {
  getMe,
  editUser,
  searchUsers,
  updateRelation,
  getUserSettings,
  editUserSettings
};
