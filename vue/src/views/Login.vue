<template>
    <div class="accessContainer">
        <div class="accessForm">
            <h1>Welcome back!</h1>
            <form @submit.prevent="login">
                <label for="email">Email</label>
                <input v-model="email" type="email" name="email" value />

                <label for="password">Password</label>
                <input v-model="password" type="password" name="password" value />
                <p><router-link to="/">Forgot your password?</router-link></p>

                <button type="submit" name="button">Login</button>
                <p>Don't have an account? <router-link to="/register">Register</router-link></p>
                <p>{{ error }}</p>
            </form>
        </div>
    </div>
</template>

<script>
// @ is an alias to /src

export default {
    data() {
        return {
            email: "",
            password: ""
        };
    },
    methods: {
        login() {
            this.$store
                .dispatch("login", {
                    email: this.email,
                    password: this.password
                })
                .then(() => {
                    this.$router.push({ name: "dashboard" });
                })
                .catch(err => {
                    this.error = err.response.data.error;
                    console.log(this.error);
                });
        }
    }
};
</script>
