<template>
  <div class="queue">
    <h1>Queue component</h1>
    <label for='firstOption' >Games</label><br />
    <select v-model="firstOption" :selected="0">
      <option disabled value="">Select your game</option>
      <option
        v-for="(queuegame, index) in queuegames"
        v-bind:key="queuegame.id"
        :value="index"
        >{{ queuegame.name }}</option
      >
    </select><br />
    <label for='firstOption' >Options</label><br />
    <select
      v-model="secondOption"
      :selected="0"
      v-if="this.queuegames[firstOption]"
    >
      <option disabled value="">Select your option</option>
      <option
        v-for="option in queuegames[firstOption].options"
        v-bind:key="option.id"
        >{{ option.name }}</option
      >
    </select><br />
    <button type="button" class="logoutButton" @click="lounge">
      Queue up/Enter Longue
    </button>
    <template>
      <component :is="mainComponent"></component>
    </template>
  </div>
</template>

<script>
import { getQueueGames } from "@/services/queue.api";

import Lounge from "@/components/Lounge";

export default {
  name: "Queue",
  data() {
    return {
      childMessage: "",
      mainComponent: null,
      queuegames: [],
      firstOption: "",
      secondOption: "",
    };
  },
  computed: {
    option: function() {
      console.log(this.queuegames[this.firstOption]);
      return this.queuegames[this.firstOption];
    },
  },
  methods: {
    lounge() {
      if (this.mainComponent == null) {
        this.mainComponent = Lounge;
        console.log("lounge");
      } else {
        this.mainComponent = null;
      }
    },
  },
  async mounted() {
    try {
      const response = await getQueueGames();
      this.queuegames = response.data;

      console.log(this.queuegames);

      // adds friends to either online of offline array :)
      /* this.friends.forEach(item => {
        if (item.status.name == "online") {
          this.onlineFriends.push(item);
        }
        if (item.status.name == "offline") {
          this.offlineFriends.push(item);
        }
      });*/
    } catch (error) {
      console.log(error);
    }
  },
};
</script>

<style></style>
