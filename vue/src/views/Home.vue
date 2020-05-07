<template>
  <div v-if="!loggedIn">
    <p>Homepage</p>
    To use this app you'll need to
    <router-link to="/login">Login</router-link>or
    <router-link to="/register">Register</router-link>
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
