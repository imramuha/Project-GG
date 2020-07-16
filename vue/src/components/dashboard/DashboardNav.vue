<template>
  <div class="dashboardNav">
    <button
      @click="feed"
      :class="{ navButtonActive: isActive === 'feed' }"
      v-on:click="emitToDashboard"
    >
      Feed
    </button>
    <button
      @click="inbox"
      :class="{ navButtonActive: isActive === 'inbox' }"
      v-on:click="emitToDashboard"
    >
      Inbox
    </button>
    <button
      @click="games"
      :class="{ navButtonActive: isActive === 'games' }"
      v-on:click="emitToDashboard"
    >
      Games
    </button>
    <button
      @click="reviews"
      :class="{ navButtonActive: isActive === 'reviews' }"
      v-on:click="emitToDashboard"
    >
      Reviews
    </button>
    <button
      @click="posts"
      :class="{ navButtonActive: isActive === 'posts' }"
      v-on:click="emitToDashboard"
    >
      Posts
    </button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      childMessage: "",
      isActive: "feed"
    };
  },
  methods: {
    feed() {
      this.childMessage = "feed";
      this.isActive = "feed";
    },
    inbox() {
      this.childMessage = "inbox";
      this.isActive = "inbox";
    },
    games() {
      this.childMessage = "games";
      this.isActive = "games";
    },
    reviews() {
      this.childMessage = "reviews";
      this.isActive = "reviews";
    },
    posts() {
      this.childMessage = "posts";
      this.isActive = "posts";
    },
    emitToDashboard() {
      this.$emit("emitToDashboard", this.childMessage);
    }
  }
};
</script>

<style scoped></style>
