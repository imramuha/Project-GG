<template>
  <div class="profileGameCard">
    <div class="profileGameCardImage">
      <img src="@/assets/images/game.png" />
      <div class="profileGameCardName">{{ game.game.name }}</div>
    </div>
    <div class="profileGameCardUsername">{{ game.data.username }}</div>
  </div>
</template>
<script>
export default {
  name: "ProfileGameCard",
  props: {
    game: {
      type: Object,
      default: () => {
        return {};
      }
    }
  }
};
</script>
<style scoped></style>
