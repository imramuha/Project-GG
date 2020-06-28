<template>
  <div class="forumContainer">
    <div class="forumSort">
      <button class="forumButtonActive">New</button>
      <button>Top</button>
      <button>Liked</button>
    </div>
    <div class="forumPosts">
      <p>Forum posts</p>
      <template >
        <ForumPostCard v-on:emitToForum="emitToOverscreen" v-for="post in posts" v-bind:key="post.id" :post="post" />
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
      //isLoading: true,
      posts: []
    };
  },
  computed: {
    ...mapGetters("Forum", ["getPosts"])
  },
  methods: {
    ...mapActions("Forum", ["fetchPosts"]),
    emitToOverscreen(value) {
      console.log('hi');
      console.log(value);
        this.$emit("emitToOverscreen", value);
    }
  },
  async mounted() {
    await this.fetchPosts()
    this.posts = this.getPosts
    console.log(this.posts);
  }
};
</script>
