<template>
  <div class="dashboardNav">
    <button @click="feed" v-on:click="emitToDashboard">
      Feed
    </button>
    <button @click="inbox" v-on:click="emitToDashboard">
      Inbox
    </button>
    <button @click="games" v-on:click="emitToDashboard">
      Games
    </button>
    <button @click="reviews" v-on:click="emitToDashboard">
      Reviews
    </button>
    <button @click="posts" v-on:click="emitToDashboard">
      Posts
    </button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      childMessage: ""
    };
  },
  methods: {
    feed() {
      this.childMessage = "feed";
    },
    inbox() {
      this.childMessage = "inbox";
    },
    /*news() {
      this.childMessage = "news";
    },*/
    games() {
      this.childMessage = "games";
    },
    reviews() {
      this.childMessage = "reviews";
    },
    posts() {
      this.childMessage = "posts";
    },
    emitToDashboard() {
      this.$emit("emitToDashboard", this.childMessage);
    }
  }
};
</script>

<style scoped></style>
