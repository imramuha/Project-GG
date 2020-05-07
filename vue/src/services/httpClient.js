import axios from "axios";

const httpClient = axios.create({
  baseURL: process.env.VUE_APP_BASE_URL,
  // timeout: 1000, // indicates, 1000ms ie. 1 second
});


const userData = localStorage.getItem("user");
const user = JSON.parse(userData);

const authInterceptor = config => {
  config.headers["Authorization"] = `Bearer ${user.token}`;
  return config;
};

httpClient.interceptors.request.use(authInterceptor);

export default httpClient;
