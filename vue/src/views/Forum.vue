<template>
  <div class="forumContainer">
    <div class="forumSort">
      <h1>Forum</h1>
      <button
        :class="{ forumButtonActive: active === 'new' }"
        v-on:click="sortPosts('new')"
      >
        New
      </button>
      <button
        :class="{ forumButtonActive: active === 'top' }"
        v-on:click="sortPosts('top')"
      >
        Top liked
      </button>
      <button
        :class="{ forumButtonActive: active === 'liked' }"
        v-on:click="sortPosts('liked')"
      >
        Your likes
      </button>
    </div>
    <div v-if="loading" class="ldsContainer">
      <div class="ldsRipple">
        <div></div>
        <div></div>
      </div>
    </div>
    <div v-if="!loading" class="forumPosts">
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
      posts: [],
      active: "new",
      loading: true,
    };
  },
  computed: {
    ...mapGetters("Forum", ["getNewPosts", "getTopPosts", "getLikedPosts"]),
  },
  methods: {
    ...mapActions("Forum", [
      "fetchNewPosts",
      "fetchTopPosts",
      "fetchLikedPosts",
    ]),

    async sortPosts(value) {
      console.log(value);
      if (value === "new") {
        await this.fetchNewPosts().then(() => {
          this.posts = this.getNewPosts.data;
        });
        this.active = "new";
      } else if (value === "top") {
        this.fetchTopPosts().then(() => {
          this.posts = this.getTopPosts.data;
        });
        this.active = "top";
        console.log(this.active);
      } else if (value === "liked") {
        this.fetchLikedPosts().then(() => {
          this.posts = this.getLikedPosts;
        });
        this.active = "liked";
      }
    },

    async emitToOverscreen(value) {
      console.log(value);
      // when someone likes a post -> we recall our data
      if (value.component == "remount" && this.active == "new") {
        await this.fetchNewPosts().then(() => {
          this.posts = this.getNewPosts.data;
        });
        this.active = "new";
      } else if (value.component == "remount" && this.active == "top") {
        this.fetchTopPosts().then(() => {
          this.posts = this.getTopPosts.data;
        });
        this.active = "top";
        console.log(this.active);
      } else if (value.component == "remount" && this.active == "liked") {
        this.fetchLikedPosts().then(() => {
          this.posts = this.getLikedPosts;
        });
        this.active = "liked";
      } else {
        this.emitToOverscreen(value);
      }
    },
  },
  async mounted() {
    await this.fetchNewPosts();
    await this.fetchTopPosts();
    await this.fetchLikedPosts();
    this.posts = this.getNewPosts.data;
    this.loading = false;
    console.log(this.posts);
  },
};
</script>
