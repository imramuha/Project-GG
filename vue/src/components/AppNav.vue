<template>
  <div class="accessNavigation">
    <router-link v-if="!loggedIn" to="/"
      ><img src="@/assets/images/logo.svg"
    /></router-link>
    <router-link
      class="loginButton"
      v-if="!loggedIn && this.$route.path !== '/login'"
      to="/login"
      >Login</router-link
    >
    <router-link
      class="loginButton"
      v-if="!loggedIn && this.$route.path == '/login'"
      to="/register"
      >Register</router-link
    >
  </div>
</template>

<script>
import { authComputed } from "../store/helpers.js";
export default {
  computed: {
    ...authComputed
  }
};
</script>

<style scoped></style>
