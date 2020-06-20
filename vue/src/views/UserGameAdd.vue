<template>
    <div class="gameForm">
      <div class="gameFormHeader">
        <h1>ADD A GAME</h1>
      </div>
      <div class="gameFormBody">
          <form @submit.prevent="onSubmit">
            <label for="game_id">Game</label>
              <select v-model="game_id">
                  <option disabled value>Select a game</option>
                  <option
                      v-for="usergameunundded in usergamesunundded"
                      v-bind:key="usergameunundded.id"
                      :value="usergameunundded.id"
                  >{{ usergameunundded.name }}</option>
              </select>

              <label for="username">Username</label>
              <input id="username" v-model="username" />

              <label for="data">Extra info</label>
              <input id="data" v-model="data" />

              <button type="submit" >Add</button>
              
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
            game_id: null
        };
    },
    methods: {
        async onSubmit() {
            let userGameData = {
                game_id: this.game_id,
                username: this.username,
                data: this.data
            };

            try {
                let response = await addUserGame(userGameData);

                console.log(response);

                this.username = null;
                this.data = null;
            } catch (error) {
                console.log(error);
            }
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
