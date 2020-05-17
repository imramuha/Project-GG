<template>
  <div class="accessNavigation">
    
    <router-link v-if="!loggedIn" to="/"><img src="@/assets/images/logo.svg"></router-link>
    <router-link v-if="!loggedIn" to="/login" class="button">Login</router-link>

  </div>
</template>

<script>
import { authComputed } from "../store/helpers.js";
export default {
  computed: {
    ...authComputed
  },
};
</script>

<style scoped>

</style>
