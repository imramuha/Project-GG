<template>
  <div class="postCard">
    <a @click="removeUserGame" 
      >
      <div class="postcardImg">
        <img src="https://placekitten.com/250/250" />
      </div>
      <div class="postcardContent">
        <div class="postcardContentHeader">
          <h1>{{ game.game.name }}</h1>
        </div>
        <div class="postcardContentBody">
        <p>{{ game.data.username }}</p>
        <p>
          {{ game.data.data }}
        </p>
        </div>
      </div>
    </a>
  </div>
</template>

<script>

import { removeUserGame } from "@/services/game.api";


export default {
  name: "GameCard",
  props: {
    game: {
      type: Object,
      default: () => {
        return {};
      },
    },
  },
  methods: {
     async removeUserGame() {
      let data = {
        game_id: this.game.game.id,
      }
      try {
        let response = await removeUserGame(data);
        console.log(response);

      } catch (error) {
        console.log(error);
      }
    },
  }
};
</script>
<style scoped></style>
