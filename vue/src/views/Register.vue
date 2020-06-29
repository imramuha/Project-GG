<template>
  <div class="accessContainer">
    <div class="accessForm">
      <h1>Create an account</h1>
      <form @submit.prevent="register">
        <label for="username">Username</label>
        <input v-model="username" type="text" name="username" value />

        <label for="email">Email</label>
        <input v-model="email" type="email" name="email" value />

        <label for="password">Password</label>
        <input v-model="password" type="password" name value />
        <label class="container"
          >I have read and agree to ProjectGG's
          <router-link to="/">Terms of Service</router-link> and
          <router-link to="/">Privacy Policy</router-link>.
          <input type="checkbox" />
          <span class="checkmark"></span>
        </label>

        <button type="submit" name="button">Register</button>
        <p>
          Already have an account?
          <router-link to="/login">Login</router-link>
        </p>

        <!--<ul>
          <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
        </ul>-->
      </form>
    </div>
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
        })
        .catch(err => {
          this.errors = err.response.data.errors;
        });
    }
  }
};
</script>

<style scoped></style>
