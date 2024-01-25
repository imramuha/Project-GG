<template>
  <div class="dashboardNav">
    <button
      @click="feed"
      :class="{ navButtonActive: isActive == 'feed' }"
      v-on:click="emitToDashboard"
    >
      Feed
    </button>
    <button
      @click="inbox"
      :class="{ navButtonActive: isActive == 'inbox' }"
      v-on:click="emitToDashboard"
    >
      Inbox
    </button>
    <button
      @click="games"
      :class="{ navButtonActive: isActive == 'games' }"
      v-on:click="emitToDashboard"
    >
      Games
    </button>
    <button
      @click="reviews"
      :class="{ navButtonActive: isActive == 'reviews' }"
      v-on:click="emitToDashboard"
    >
      Reviews
    </button>
    <button
      @click="posts"
      :class="{ navButtonActive: isActive == 'posts' }"
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
  props: {
    content: {
      type: String,
      default: () => {
        return {};
      }
    }
  },
  watch: {
    content: function() {
      this.checkActive(this.content);
    }
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
    },
    checkActive(content) {
      content = this.content;
      if (content === "feed") {
        this.isActive = "feed";
      } else if (content === "posts") {
        this.isActive = "posts";
      } else if (content === "inbox") {
        this.isActive = "inbox";
      } else if (content === "games") {
        this.isActive = "games";
      } else if (content === "posts") {
        this.isActive = "posts";
      } else if (content === "reviews") {
        this.isActive = "reviews";
      } else {
        this.isActive = "feed";
      }
    }
  },
  mounted() {
    this.checkActive(this.content);
  }
};
</script>

<style scoped></style>
