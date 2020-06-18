<template>
    <div>
        <form class="gameform" @submit.prevent="onSubmit">
            <p>
                <select v-model="game_id">
                    <option disabled value>Select a game</option>
                    <option
                        v-for="usergameunundded in usergamesunundded"
                        v-bind:key="usergameunundded.id"
                        :value="usergameunundded.id"
                    >{{ usergameunundded.name }}</option>
                </select>
            </p>
            <p>
                <label for="username">Username</label>
                <input id="username" v-model="username" placeholder="username" />
            </p>
            <p>
                <label for="data">Extra info</label>
                <input id="data" v-model="data" placeholder="info" />
            </p>

            <p>
                <input type="submit" value="Submit" />
            </p>
        </form>
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
    };
  },
  methods: {
    async onSubmit() {
      let userGameData = {
        game_id: this.game_id,
        username: this.username,
        data: this.data,
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
  },
};
</script>

<style scoped></style>
