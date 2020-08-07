<template>
  <div class="accessNavigation">
    <router-link
      v-if="
        this.$route.path === '/' ||
          this.$route.path === '/login' ||
          this.$route.path === '/register'
      "
      to="/"
    >
      <img v-if="this.theme == 'dark'" src="@/assets/images/logo.svg" />
      <img v-else src="@/assets/images/logoDark.svg" />
    </router-link>
    <router-link
      class="loginButton"
      v-if="
        (!loggedIn && this.$route.path === '/') ||
          this.$route.path === '/register'
      "
      to="/login"
      >Login</router-link
    >
    <router-link
      class="loginButton"
      v-if="!loggedIn && this.$route.path === '/login'"
      to="/register"
      >Register</router-link
    >
    <a
      class="loginButton logoutButton"
      v-if="loggedIn && this.$route.path === '/'"
      @click="logout"
      title="Logout"
    >
      Logout</a
    >
  </div>
</template>

<script>
import { authComputed } from "../store/helpers.js";
import { getUserSettings } from "@/services/user.api";

export default {
  computed: {
    ...authComputed,
  },
  props: {
    mode: {
      type: String,
    },
  },
  data() {
    return {
      theme: "dark",
    };
  },
  async mounted() {
    // based on the usersettings changes the theme and svg type
    let htmlElement = document.documentElement;
      await getUserSettings().then((response) => {
        if (!response.data[0].nightmode == 1) {
          this.theme = "light";
          htmlElement.setAttribute("theme", "light");
        } else {
          this.theme = "dark";
          htmlElement.setAttribute("theme", "dark");
        }
      }).catch((error) => {
        console.log(error.response.data.message);
      });
  },
  watch: {
    // gets the mode from the app emit
    mode: function(value) {
      this.theme = value;
    },
  },
  methods: {
    logout() {
      this.$store.dispatch("logout").then(() => {
        this.$router.push("/");
      });
    },
  },
};
</script>

<style scoped></style>
