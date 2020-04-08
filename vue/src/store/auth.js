import axios from 'axios';

export default {
    namespaced: true,
    state: {
        // state of your app, you can store anything, bject, strings, ..
        token: null,
        user: null,
    },

    getters: {
        // lets you read the information from the states

    },

    mutations: {
        // will update the state
        SET_TOKEN (state, token) {
            state.token = token;
        },
        SET_USER (state, data) {
            state.user = data;
        }
    },
    actions: {
        // make request to api, will commit to mutaitons
        // 1 login us in but isn't checking i the token is valid 
        async login({ dispatch }, credentials) {
            let response = await axios.post("auth/login", credentials);

            // once the tokens come back succesfully we pass the token to attempt
            dispatch('attempt', response.data.token)
        },

        // attempt to auth
        async attempt ({ commit }, token) {
            // 2 attempt will do that by setting the token and sending it with the header to get the user back <-- check if token is valis
            // commit to store the token ^ to our state
            commit('SET_TOKEN', token)

            // try and catch to check if users token actually works
            try {
                let response = await axios.get('auth/me', {
                    headers: {
                        'Authorization': 'Bearer' + token
                    }
                });

                // data we receive store into the store
                commit('SET_USER', response.data)
            } catch (e) {
                console.log('failed');
                commit('SET_TOKEN', null)
                commit('SET_USER', null)
            }
        }
    },
};
