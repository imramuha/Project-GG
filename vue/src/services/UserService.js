import axios from 'axios'
   
/*
const apiClient = axios.create({  
  baseURL: `http://127.0.0.1:8000/api/frontend`,
  withCredentials: false, // This is the default
  headers: {
    Accept: 'application/json',
    'Content-Type': 'application/json'
  }
})*/

export default {
  getFriends() {
    return axios.get('/frontend/users')
  },
   getFriend(id) {
    return axios.get('/frontend/user/' + id)
  }
}