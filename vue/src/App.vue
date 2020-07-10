<template>
  <div class="app">
    <div class="wrapper">
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
    </div>
    <AppNav />
    <router-view class="page" />
  </div>
</template>

<script>
//import Navigation from "@/components/Navigation";
import AppNav from "@/components/AppNav";

export default {
  components: {
    AppNav,
  },
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
  width: 100vw;
  height: 100vh;
  display: flex;
}
</style>
