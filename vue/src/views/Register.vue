<template>
  <div class="accessContainer">
    <div class="accessForm">
      <h1>Create an account</h1>
      <p v-if="errors.length">
        <b>Please correct the following error(s):</b>
      </p>

      <ul>
        <li v-for="error in errors" v-bind:key="error">{{ error }}</li>
      </ul>
      <form @submit.prevent="register">
        <label for="username">Username</label>
        <input v-model="username" type="text" name="username" value />

        <label for="email">Email</label>
        <input v-model="email" type="email" name="email" value />

        <label for="password">Password</label>
        <input v-model="password" type="password" name value />

        <label class="container"
          >I have read and agree to ProjectGG's
          <router-link to="/terms">Terms of Service</router-link> and
          <router-link to="/privacy">Privacy Policy</router-link>.
          <input type="checkbox" v-model="opting" />
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
      password: "",
      opting: "",
      errors: []
    };
  },
  methods: {
    register() {
      this.errors = [];

      if (!this.username) {
        this.errors.push("Username is required!");
      }
      if (!this.email) {
        this.errors.push("Email is required!");
      }
      if (!this.password) {
        this.errors.push("Password is required!");
      }
      if (!this.opting) {
        this.errors.push(
          "Please check the box or read and decide if you would like to register or not."
        );
      } else if (this.username && this.email && this.password && this.opting) {
        this.$store
          .dispatch("register", {
            username: this.username,
            email: this.email,
            password: this.password
          })
          .then(() => {
            this.$router.push({ name: "dashboard" });
          })
          .catch(err => {
            if (err.username) {
              this.errors.push(err.username[0]);
            }
            if (err.email) {
              this.errors.push(err.email[0]);
            }
            if (err.password) {
              this.errors.push(err.password[0]);
            }
          });
      }
    }
  }
};
</script>

<style scoped></style>
