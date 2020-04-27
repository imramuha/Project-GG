<template>
    <div>
        <form @submit.prevent="register">
            <label for="username">Username:</label>
            <input v-model="username" type="text" name="username" value />

            <label for="email">Email:</label>
            <input v-model="email" type="email" name="email" value />

            <label for="password">Password:</label>
            <input v-model="password" type="password" name value />

            <button type="submit" name="button">Register</button>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            username: "",
            email: "",
            password: ""
        };
    },
    methods: {
        register() {
            this.$store
                .dispatch("register", {
                    name: this.name,
                    email: this.email,
                    password: this.password
                })
                .then(() => {
                    this.$router.push({ name: "dashboard" });
                });
        }
    }
};
</script>

<style scoped></style>
