<template>
  <div class="queuelounge">
    <div class="queue">
      <div class="queueHeader"><p>QUEUE</p></div>
      <div class="queueBody">
        <div class="queueForm">
          <div class="queueGames">
            <label for="firstOption">Games</label>
            <select v-model="firstOption" :selected="0">
              <option disabled value>Select your game</option>
              <option
                v-for="(queuegame, index) in queuegames"
                v-bind:key="queuegame.id"
                :value="index"
                >{{ queuegame.name }}</option
              >
            </select>
          </div>

          <div class="queueOptions">
            <label for="firstOption">Options</label>
            <select
              v-model="secondOption"
              :selected="0"
              v-if="this.queuegames[firstOption]"
            >
              <option disabled value>Select your option</option>
              <option
                v-for="(option, index) in queuegames[firstOption].options"
                v-bind:key="option.id"
                :value="index"
                >{{ option.name }}</option
              >
            </select>
          </div>
        </div>
      </div>
      <div class="queueUp">
        <button type="button" class="logoutButton" @click="lounge">
          JOIN
        </button>
      </div>
    </div>

    <div class="lounge">
      <div class="loungeHeader"><p>LOUNGE</p></div>
      <div class="loungeBody">
        <template>
          <component
            :lobby="lobby"
            v-bind:key="lobby.id"
            :is="mainComponent"
          ></component>
        </template>
      </div>
      <div class="loungeButtons">
        <button>REVEAL</button>
        <button>LEAVE</button>
      </div>
    </div>
  </div>
</template>

<script>
import { getQueueGames, queue } from "@/services/queue.api";

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
      lobby: "",
    };
  },
  computed: {
    option: function() {
      console.log(this.queuegames[this.firstOption]);
      return this.queuegames[this.firstOption];
    },
  },
  methods: {
    async lounge() {
      let lounge = {
        name:
          this.queuegames[this.firstOption].name +
          " [" +
          this.queuegames[this.firstOption].options[this.secondOption].name +
          "]",
        code:
          this.firstOption +
          "-" +
          this.queuegames[this.firstOption].options[this.secondOption].id,
      };
      this.lobby = lounge;
      try {
        await queue(lounge).then((response) => {
          console.log(response.data.data);
          this.lobby.id = response.data.data;
          console.log(this.lobby.id);
          if (this.mainComponent == null) {
            this.mainComponent = Lounge;
          } else {
            this.mainComponent = null;
          }
        });

        this.name = null;
        this.code = null;
      } catch (error) {
        console.log(error);
      }
    },
  },
  async mounted() {
    try {
      const response = await getQueueGames();
      this.queuegames = response.data;

      //console.log(this.queuegames);
    } catch (error) {
      console.log(error);
    }
  },
};
</script>

<style></style>
