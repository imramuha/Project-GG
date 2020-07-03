<template>
  <div class="landingsPage">
    <div class="landingsPageBody">
      <div class="landingsPageBodyContent">
        <h1>A use this app you'll need to</h1>
        <p>
          subtitle for now it'll change once we get some more info :), subtitle
          for now it'll change once we get some more info :), subtitle for now
          it'll change once we get some more info :)
        </p>
        <router-link to="/register"><button>Join</button></router-link>
      </div>
      <div class="landingsPageBodyIcons">
        <div>icon 1</div>
        <div>icon 2</div>
        <div>icon 3</div>
        <div>icon 4</div>
      </div>
    </div>
    <div class="landingsPageFooter">
      <router-link to='/privacy'>Privacy Policy</router-link>
      <router-link to="/terms">Terms & Conditions</router-link>
    </div>
  </div>
</template>

<script>
import { authComputed } from "../store/helpers.js";

export default {
  computed: {
    ...authComputed,
  },
};
</script>
