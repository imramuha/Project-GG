<template>
  <div class="postCard">
    <router-link :to="{ name: 'post', params: { id: game.id } }"
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
    </router-link>
  </div>
</template>
<script>
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
};
</script>
<style scoped></style>
