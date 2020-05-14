<template>
  <div class="accessNavigation">
    <router-link to="/">Home</router-link>
    <router-link v-if="loggedIn" to="/dashboard">Dashboard</router-link>
    <router-link v-if="loggedIn" to="/forum" class="button">Forum</router-link>

    <router-link v-if="!loggedIn" to="/login" class="button">Login</router-link>
    <button v-else type="button" class="logoutButton" @click="logout">
      Logout
    </button>
  </div>
</template>

<script>
import { authComputed } from "../store/helpers.js";
export default {
  computed: {
    ...authComputed
  },
  methods: {
    logout() {
      this.$store.dispatch("logout");
    }
  }
};
</script>

<style scoped>

</style>
