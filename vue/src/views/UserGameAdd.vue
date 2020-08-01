<template>
  <div class="gameForm">
    <div class="gameFormHeader">
      <h1>ADD A GAME</h1>
      <p v-if="errors.length">
        <b>Please correct the following error(s):</b>
        <ul>
          <li v-for="error in errors" v-bind:key="error" >- {{ error }}</li>
        </ul>
      </p>
    </div>
    <div class="gameFormBody">
      <form @submit.prevent="onSubmit">
        <label for="game_id">Game</label>
        <select v-model="game_id">
          <option disabled value=0>Select a game</option>
          <option
            v-for="usergameunundded in usergamesunundded"
            v-bind:key="usergameunundded.id"
            :value="usergameunundded.id"
            >{{ usergameunundded.name }}</option
          >
        </select>

        <label for="username">Username</label>
        <input id="username" v-model="username" placeholder="username or gamertag"/>

        <label for="data">Extra info</label>
        <input id="data" v-model="data" placeholder="any extra info" />

        <button type="submit">Add</button>
      </form>
    </div>
  </div>
</template>
<script>
import { getUserGamesUnadded, addUserGame } from "@/services/game.api";

export default {
  name: "UserGameAdd",
  // get all the unadded games and then post them do gameuserdata tae latest one exists;
  data() {
    return {
      usergamesunundded: [],
      username: null,
      data: null,
      game_id: null,
      errors: [],
    };
  },
  methods: {
    async onSubmit() {
      this.errors = [];

       if(!this.game_id) {
          this.errors.push('Please select a game!');

      } if(!this.username) {
          this.errors.push('Username/Gamertag is required for each game!');
      } else if (this.game_id && this.username) {

        let userGameData = {
          game_id: this.game_id,
          username: this.username,
          data: this.data
        };

        await addUserGame(userGameData).then((response) => {
          this.$store
          .dispatch("notification", {
            message: response.data[0].response,
          })
          .then(() => {
            this.emitToDashboard('games');
            //this.$router.push('dashboard');
          })
          .catch((errors) => {
            console.log(errors);
          });

this.game_id = null
          this.username = null;
          this.data = null;

        }).catch((errors) => {
          const err = errors.response.data.errors;
          if(err.game_id) {
            this.errors.push('You have to select a game.')
          } if(err.username) {
            this.errors.push( err.username[0] )
          } if(err.data) {
            this.errors.push( err.data[0] )
          }   
        });
      }
    },
    emitToDashboard(component) {
      this.$emit("emitToDashboard", component);
    }
  },
  async mounted() {
    try {
      const response = await getUserGamesUnadded();
      this.usergamesunundded = response.data;

      console.log(this.usergamesunundded);
    } catch (error) {
      console.log(error);
    }
  }
};
</script>

<style scoped></style>
