<template>
  <div class="postCard">
    <div class="postcardImg">
      <div v-if="game.game.image">
        <img :src="game.game.image" />
      </div>
      <div v-else>
        <img src="@/assets/images/game.png" />
      </div>
    </div>
    <div class="postcardContent">
      <div class="postcardContentHeader">
        <h1>{{ game.game.name }}</h1>
      </div>
      <div class="postcardContentBody">
        <p>{{ game.data.username }}</p>
        <p>{{ game.data.data }}</p>
      </div>
      <div class="gameRemoveButton">
        <button @click="removeUserGame">Unfavorite</button>
      </div>
    </div>
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
      }
    }
  },
  methods: {
    async removeUserGame() {
      let data = {
        game_id: this.game.game.id
      };
      try {
        await removeUserGame(data).then(response => {
          this.$store
            .dispatch("notification", {
              message: response.data[0].response
            })
            .then(() => {
              //this.$router.push('dashboard');
            })
            .catch(errors => {
              console.log(errors);
            });
        });
      } catch (error) {
        console.log(error);
      }
    }
  }
};
</script>
<style scoped></style>
