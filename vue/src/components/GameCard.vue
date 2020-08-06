<template>
  <div class="gameCard">
    <div class="gameCardImage">
      <div v-if="game.game.image">
        <img :src="game.game.image" />
        <div class="gameCardContent">
          <div class="gameCardContentHeader">
            <h1>{{ game.game.name }}</h1>
          </div>
          <div v-if="game.data" class="gameCardContentBody">
            <p>{{ game.data.username }}</p>
            <p>{{ game.data.data }}</p>
          </div>
        </div>
      </div>
      <div v-else>
        <img src="@/assets/images/game.png" />
        <div class="gameCardHover">
          <i class="fa fa-info-circle" aria-hidden="true"></i>
        </div>
        <div class="gameCardContent">
          <div class="gameCardContentHeader">
            <h1>{{ game.game.name }}</h1>
            <p>
              <span>{{ game.data.username }}</span> [
              <i class="fa fa-desktop" aria-hidden="true"></i> ]
            </p>
          </div>
          <div class="gameCardContentBody">
            <p>{{ game.data.data }}</p>
          </div>
        </div>
      </div>
    </div>

    <div class="gameCardRemoveButton">
      <button @click="removeUserGame">Unfavorite</button>
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
              this.emitToGames();
            })
            .catch(errors => {
              console.log(errors);
            });
        });
      } catch (error) {
        console.log(error);
      }
    },
    emitToGames() {
      this.$emit("emitToGames");
    }
  }
};
</script>
<style scoped></style>
