import httpClient from "./httpClient";

const ADD_REPORT_END_POINT = "/api/frontend/addreport";

const addReport = data => httpClient.post(ADD_REPORT_END_POINT, data);

export { addReport };
