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
        <div class="queueErrors">
         <p v-if="errors.length">
            <b>Please correct the following error(s):</b>
            <ul>
              <li v-for="error in errors" v-bind:key="error" >- {{ error }}</li>
            </ul>
          </p>
        </div>
      </div>
      <div class="queueUp">
        <button type="button" class="logoutButton" @click="lounge">
          JOIN
        </button>
      </div>
    </div>

    <template>
      <component
        :lobby="lobby"
        v-bind:key="lobby.id"
        :is="mainComponent"
      ></component>
    </template>

  </div>
</template>

<script>
import { getQueueGames, queue } from "@/services/queue.api";

import Lounge from "@/components/Lounge";

export default {
  name: "Queue",
  components: {
   Lounge
  },
  data() {
    return {
      childMessage: "",
      mainComponent: null,
      queuegames: [],
      firstOption: "",
      secondOption: "",
      lobbyComponent: null,
      lobby: "",
      errors: [],
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
      this.errors = [];
      try {
        if(!this.queuegames[this.firstOption]) {
            this.errors.push('Please select a game!');
        } if (!this.queuegames[this.firstOption].options[this.secondOption]) {
            this.errors.push('Please select an option');
        } else {

          let loungeName = this.queuegames[this.firstOption].name + " [" + this.queuegames[this.firstOption].options[this.secondOption].name + "]";
          let loungeCode = this.firstOption + "-" + this.queuegames[this.firstOption].options[this.secondOption].id;

          let lounge = {
            name: loungeName,
            code: loungeCode,
          };

          this.lobby = lounge;

          await queue(lounge).then((response) => {
            console.log(response.data);
            this.$store
            .dispatch("notification", {
              message: response.data.response,
            })
            .then(() => {
              // the lounge component is visible to do:
              if (this.mainComponent == null) {
                this.mainComponent = Lounge;
                this.lobbyComponent = 'lobby'
              } else {
                this.mainComponent = null;
              }

              this.lobby.id = response.data.data;

              this.name = null;
              this.code = null;
            })
            .catch((errors) => {
              console.log(errors);
            });
          });
        }
      } catch (errors) {
          let err = errors.response.data.errors;
          console.log(errors);
          if(err.name) {
            this.errors.push(err.name[0] )
          }
          if(err.code) {
            this.errors.push(err.code[0] )
          }
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
