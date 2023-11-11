<template>
  <div class="app">
    <div class="wrapper">
      <div></div>
      <div class="triangle"></div>
      <div></div>
      <div></div>
      <div class="triangle"></div>
    </div>
    <AppNav :mode="mode" />
    <router-view v-on:emitToAppNav="shiftMode" class="page" />
  </div>
</template>

<script>
//import Navigation from "@/components/Navigation";
import AppNav from "@/components/AppNav";
import "@/assets/sass/abstracts/_variables.scss";

export default {
  components: {
    AppNav
  },
  data() {
    return {
      mode: ""
    };
  },
  methods: {
    shiftMode(value) {
      this.mode = value;
    }
  }
};
</script>

<style lang="scss">
html {
  -webkit-text-size-adjust: 100%;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
body {
  margin: 0;
}
.app {
  box-sizing: border-box;
  margin: 0 auto;
  width: 100%;
  height: 100%;
  display: flex;
}
</style>
