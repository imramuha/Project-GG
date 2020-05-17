<template>
  <div class="landingsPage" v-if="!loggedIn">
    <p>To use this app you'll need to
    <router-link to="/login">Login</router-link>or
    <router-link to="/register">Register</router-link>
    </p>
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
