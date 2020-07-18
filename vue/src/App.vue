<template>
  <div class="app">
    <div class="wrapper">
      <div></div>
      <div class="circle"></div>
      <div class='triangle'></div>
      <div class="x">&times;</div>
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
    AppNav
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
