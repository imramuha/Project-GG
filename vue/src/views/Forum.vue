<template>
  <div class="forumContainer">
    <div class="forumSort">
      <button class="forumButtonActive" v-on:click="sortPosts('new')">
        New
      </button>
      <button v-on:click="sortPosts('top')">Top</button>
      <button v-on:click="sortPosts('liked')">Liked</button>
    </div>
    <div class="forumPosts">
      <h1>Forum -- !!! (under construction) !!! --</h1>
      <template>
        <ForumPostCard
          v-on:emitToForum="emitToOverscreen"
          v-for="post in posts"
          v-bind:key="post.id"
          :post="post"
        />
      </template>
    </div>
  </div>
</template>

<script>
import ForumPostCard from "@/components/ForumPostCard";
import { mapActions, mapGetters } from "vuex";

export default {
  components: { ForumPostCard },
  data() {
    return {
      posts: []
    };
  },
  computed: {
    ...mapGetters("Forum", ["getNewPosts", "getTopPosts", "getLikedPosts"])
  },
  methods: {
    ...mapActions("Forum", [
      "fetchNewPosts",
      "fetchTopPosts",
      "fetchLikedPosts"
    ]),

    async sortPosts(value) {
      console.log(value);
      if (value === "new") {
        await this.fetchNewPosts().then(() => {
          this.posts = this.getNewPosts.data;
        });
      } else if (value === "top") {
        this.fetchTopPosts().then(() => {
          this.posts = this.getTopPosts.data;
        });
      } else if (value === "liked") {
        this.fetchLikedPosts().then(() => {
          this.posts = this.getLikedPosts;
        });
      }
    },

    emitToOverscreen(value) {
      this.$emit("emitToOverscreen", value);
    }
  },
  async mounted() {
    await this.fetchNewPosts();
    await this.fetchTopPosts();
    await this.fetchLikedPosts();
    this.posts = this.getNewPosts.data;
    console.log(this.posts);
  }
};
</script>
