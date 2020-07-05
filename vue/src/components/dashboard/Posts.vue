<template>
  <div class="postsboard">
    <div class="posts">
      <PostCard
        v-for="userpost in userposts"
        v-bind:key="userpost.id"
        :post="userpost"
        v-on:emitToPosts="onPostCardClick"
      />
    </div>
    <div class="postsFooter">
      <div class="postsNav">
        <button>Previous</button>
        <p>1 - 2 - 3 - 4</p>
        <button>Next</button>
      </div>
      <div class="postsFooterButtons">
        <a v-on:click="onClickCreate"><button>Create</button></a>
      </div>
    </div>
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
      userposts: []
    };
  },
  computed: {
    ...mapGetters("Forum", ["getUserPosts"])
  },
  methods: {
    ...mapActions("Forum", ["fetchUserPosts"]),
    async onPostCardClick(value) {
      // when someone likes a post -> we recall our data
      if (value.component == "remount") {
        await this.fetchUserPosts();
        this.userposts = this.getUserPosts;
      } else {
        this.emitToOverscreen(value);
      }
    },
    onClickCreate() {
      let value = {
        component: "PostCreate"
      };
      this.emitToOverscreen(value);
    },
    emitToOverscreen(value) {
      this.$emit("emitToOverscreen", value);
    }
  },

  async mounted() {
    // Make network request if the data is empty
    if (this.getUserPosts.length === 0) {
      // set loading screen
      this.isLoading = true;
      // await this.fetchPosts();

      await this.fetchUserPosts();

      this.userposts = this.getUserPosts;

      this.isLoading = false;
    } else {
      this.userposts = this.getUserPosts;
      this.isLoading = false;
    }
  }
};
</script>

<style lang="scss"></style>
