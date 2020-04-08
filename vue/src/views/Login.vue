<template>
    <form @submit.prevent="submit">
        {{ form }}
        <div>
            <label for="email">email</label>

            <input type="text" name="email" id="email" v-model="form.email" />
        </div>

        <div>
            <label for="password">password</label>

            <input type="password" name="password" id="password" v-model="form.password" />
        </div>

        <div>
            <button type="submit">Login</button>
        </div>
    </form>
</template>

<script>
// @ is an alias to /src

import { mapActions } from 'vuex';

export default {
    name: "Login",
    components: {},
    data() {
        return {
            form: {
                email: "",
                password: ""
            }
        };
    },
    methods: {
        ...mapActions({
            login: 'auth/login'
        }),
        submit() {
           this.login(this.form);
        }
    }
};
</script>
