<template>
  <div class="postsboard">
    <div class="posts">
      <PostCard
        v-for="userpost in userposts"
        :key="userpost.id"
        :post="userpost"
        v-on:emitToPosts="onPostCardClick"
      />
    </div>
    <div class="postsFooter">
      <div class="postsPagination">
        <button
          v-on:click="fetchPaginatedPosts(pagination.prevPage)"
          :disabled="!pagination.prevPage"
        >
          <i class="fa fa-arrow-left" aria-hidden="true" />
        </button>
        <p>
          Page <span>{{ pagination.currentPage }}</span> of
          <span>{{ pagination.lastPage }}</span>
        </p>
        <button
          v-on:click="fetchPaginatedPosts(pagination.nextPage)"
          :disabled="!pagination.nextPage"
        >
          <i class="fa fa-arrow-right" aria-hidden="true" />
        </button>
      </div>
      <div class="postsFooterButtons">
        <a v-on:click="onClickCreate">
          <button>Create</button>
        </a>
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
      userposts: [],
      pagination: [],
      url: "/api/frontend/userposts"
    };
  },
  computed: {
    ...mapGetters("Forum", ["getUserPosts"])
  },
  methods: {
    ...mapActions("Forum", ["fetchUserPosts"]),

    createPagination(data) {
      let pagination = {
        currentPage: data.current_page,
        lastPage: data.last_page,
        nextPage: data.next_page_url,
        prevPage: data.prev_page_url
      };
      this.pagination = pagination;
    },

    async fetchPaginatedPosts(url) {
      console.log("hii");
      this.url = url;

      await this.fetchUserPosts(this.url);
      this.userposts = this.getUserPosts.data;
      this.createPagination(this.getUserPosts);
    },

    async onPostCardClick(value) {
      // when someone likes a post -> we recall our data
      if (value.component == "remount") {
        await this.fetchUserPosts(this.url);
        this.userposts = this.getUserPosts.data;
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
      await this.fetchUserPosts(this.url);

      this.userposts = this.getUserPosts.data;
      this.createPagination(this.getUserPosts);
    } else {
      this.userposts = this.getUserPosts.data;
      this.createPagination(this.userposts);
    }
  }
};
</script>

<style lang="scss"></style>
