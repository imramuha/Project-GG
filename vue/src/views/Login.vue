<template>
  <div class="accessContainer">
    <div class="accessForm">
      <h1>Welcome back!</h1>
      <p v-if="errors.length">
        <b>Please correct the following error(s):</b>
        <ul>
          <li v-for="error in errors" v-bind:key="error" >{{ error }}</li>
        </ul>
      </p>
      <form v-on:submit.prevent="login">
        <label for="email">Email</label>
        <input v-model="email" type="email" name="email" value />

        <label for="password">Password</label>
        <input v-model="password" type="password" name="password" value />
        <p><router-link to="/">Forgot your password?</router-link></p>

        <button type="submit" >Login</button>
        <p>
          Don't have an account?
          <router-link to="/register">Register</router-link>
        </p>
      </form>
    </div>
  </div>
</template>

<script>
//import httpClient from "@/services/httpClient";

export default {
  data() {
    return {
      email: "",
      password: "",
      errors: [],
    };
  },
  methods: {
    login() {
      this.errors = [];

      if(!this.email) {
          this.errors.push('Email is required!');

      } if(!this.password) {
          this.errors.push('Password is also required!');

      } else if (this.email && this.password) {
        this.$store
          .dispatch("login", {
            email: this.email,
            password: this.password
          })
          .then(() => {
            this.$router.push('dashboard');
          })
          .catch(errors => {
            console.log(errors);
            this.errors.push(errors);
          })    
        }

    }
    
  }
};
</script>
