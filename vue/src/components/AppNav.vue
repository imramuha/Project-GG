<template>
  <div class="accessNavigation">
    <router-link v-if="!loggedIn" to="/"
      ><img src="@/assets/images/logo.svg"
    /></router-link>
    <router-link v-if="!loggedIn" to="/login" class="button">Login</router-link>
    <router-link v-if="loggedIn" to="/login" class="button">Dashboard</router-link>
  </div>
</template>

<!-- this has to be visible if user is logged in (then we dont show login button
but show dashboard button instead) or not doesn't matter 
buuuuuuuuut it has to be shows on all the other pages beside dashboard -->

<script>
import { authComputed } from "../store/helpers.js";
export default {
  computed: {
    ...authComputed
  }
};
</script>

<style scoped></style>
