import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios';

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        user: null,
    },
    mutations: {
        SET_USER_DATA (state, userData) {
            state.user = userData
            localStorage.setItem('user', JSON.stringify(userData))
            axios.defaults.headers.common['Authorization'] = `Bearer ${userData.token}`    
        },
    },
    actions: {
        register({ commit }, credentials) {
            return axios
                .post('http://127.0.0.1:8000/api/auth/register', credentials)
                .then(({ data }) => {
                    console.log('user data is', data)
                    commit('SET_USER_DATA', data)
                })
        }
    }
})
