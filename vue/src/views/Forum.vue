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
    <div v-if="pagination.lastPage > 1" class="forumPagination">
      <button
        v-on:click="fetchPaginatedNewPosts(pagination.prevPage)"
        :disabled="!pagination.prevPage"
      >
        <i class="fa fa-arrow-left" aria-hidden="true" />
      </button>
      <p>
        Page <span>{{ pagination.currentPage }}</span> of
        <span>{{ pagination.lastPage }}</span>
      </p>
      <button
        v-on:click="fetchPaginatedNewPosts(pagination.nextPage)"
        :disabled="!pagination.nextPage"
      >
        <i class="fa fa-arrow-right" aria-hidden="true" />
      </button>
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
      pagination: [],
      url_new_posts: "/api/frontend/postsnew",
      url_top_posts: "/api/frontend/poststop",
      url_liked_posts: "/api/frontend/postsliked"
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

    createPagination(data) {
      let pagination = {
        currentPage: data.current_page,
        lastPage: data.last_page,
        nextPage: data.next_page_url,
        prevPage: data.prev_page_url
      };
      this.pagination = pagination;
    },

    async fetchPaginatedNewPosts(url) {
      this.url_new_posts = url;
      console.log(this.url_new_posts);

      await this.fetchNewPosts(this.url_new_posts);
      this.posts = this.getNewPosts.data;
      this.createPagination(this.getNewPosts);
    },

    async sortPosts(value) {
      console.log(value);
      if (value === "new") {
        await this.fetchNewPosts(this.url_new_posts).then(() => {
          this.posts = this.getNewPosts.data;
          this.createPagination(this.getNewPosts);
        });
        this.active = "new";
      } else if (value === "top") {
        this.fetchTopPosts(this.url_top_posts).then(() => {
          this.posts = this.getTopPosts.data;
          this.createPagination(this.getTopPosts);
        });
        this.active = "top";
        console.log(this.active);
      } else if (value === "liked") {
        this.fetchLikedPosts(this.url_liked_posts).then(() => {
          this.posts = this.getLikedPosts;
          this.createPagination(this.getLikedPosts);
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
    }
  },
  async mounted() {
    await this.fetchNewPosts(this.url_new_posts);
    await this.fetchTopPosts(this.url_top_posts);
    await this.fetchLikedPosts(this.url_liked_posts);

    this.posts = this.getNewPosts.data;
    this.createPagination(this.getNewPosts);
    this.loading = false;
  }
};
</script>
