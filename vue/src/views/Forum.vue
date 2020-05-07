<template>
  <div>
    <h1>Forum</h1>
    <template v-if="!isLoading">
    <PostCard v-for="post in posts" v-bind:key="post.id" :post="post" />
    </template>
    <p v-else>Loading posts</p>
  </div>
</template>

<script>
import PostCard from "@/components/PostCard";
import { mapActions, mapGetters } from "vuex";

export default {
   components: { PostCard },
  data() {
    return {
      isLoading: true,
      posts: [],
    };
  },
  computed: {
    ...mapGetters("Forum", ["getPosts"])
  },
  methods: {
    ...mapActions("Forum", ["fetchPosts"])
  },
  async mounted() {
    // Make network request if the data is empty
    if (this.getPosts.length === 0) {
      // set loading screen
      this.isLoading = true;

      await this.fetchPosts();

      // I need to grab the state???
      this.posts = this.getPosts;

      this.isLoading = false;
    } else {
      this.posts = this.getPosts;
      this.isLoading = false;
    }
  }
};
</script>
