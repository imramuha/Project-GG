<template>
  <div class="landingsPage">
    <div class="landingsPageBody">
      <div class="landingsPageBodyContent">
        <h1>A place to meet new friends</h1>
        <p>
          Project GG is a web based application which focuses on bringing gamers
          together.<br />
          As gamers ourselves we enjoy listening to your cries to fulfill your
          gamer needs.
        </p>
        <router-link to="/register"
          ><button>
            <!--<i class="fas fa-puzzle-piece"></i>--><span>ENTER</span>
          </button></router-link
        >
      </div>
      <div class="landingsPageBodyIcons">
        <div class="landingsPageIcon">
          <i class="fas fa-signature"></i> <span>JOIN</span>
        </div>
        <div class="landingsPageIcon">
          <i class="fa fa-users" aria-hidden="true"></i> <span>QUEUE</span>
        </div>
        <div class="landingsPageIcon">
          <i class="fa fa-link" aria-hidden="true"></i><span>CONNECT</span>
        </div>
        <div class="landingsPageIcon">
          <i class="fa fa-gamepad" aria-hidden="true"></i><span>GAME</span>
        </div>
      </div>
    </div>
    <div class="landingsPageFooter">
      <router-link to="/privacy">Privacy Policy</router-link>
      <router-link to="/terms">Terms & Conditions</router-link>
    </div>
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
