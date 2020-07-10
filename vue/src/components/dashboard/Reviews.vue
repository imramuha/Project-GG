<template>
  <div class="reviewsBoard">
    <div v-if="this.mode === 'received'" class="reviews">
      <ReviewCard
        v-for="userreview in userreviews"
        v-bind:key="userreview.id"
        :review="userreview"
      />      
    </div>
    <div v-else class="reviews">
      <ReviewCard
        v-for="userpostedreview in userpostedreviews"
        v-bind:key="userpostedreview.id"
        :review="userpostedreview"
      />
    </div>

    <div class="reviewsFooter">
      <div class="reviewsPagination">
        <button
          v-on:click="fetchPaginatedReviews(pagination.prevPage)"
          :disabled="!pagination.prevPage"
        >
          Previous
        </button>
        <p>Page {{ pagination.currentPage }} of {{ pagination.lastPage }}</p>
        <button
          v-on:click="fetchPaginatedReviews(pagination.nextPage)"
          :disabled="!pagination.nextPage"
        >
          Next
        </button>
      </div>
      <div class="reviewsHeader">
        <a
          :class="{ reviewsHeaderActive: isActive === 'received' }"
          @click="received"
        >
          <button>Received</button>
        </a>
        <a
          :class="{ reviewsHeaderActive: isActive === 'given' }"
          @click="given"
        >
          <button>Given</button>
        </a>
      </div>
    </div>
  </div>
</template>

<script>
import ReviewCard from "@/components/ReviewCard";

import { mapActions, mapGetters } from "vuex";

export default {
  components: { ReviewCard },
  data() {
    return {
      isLoading: true,
      userreviews: [],
      userpostedreviews: [],
      url_received: "/api/frontend/userreviews",
      url_given: "/api/frontend/userpostedreviews",
      pagination: [],
      mode: "received",
      isActive: "received"
    };
  },
  computed: {
    ...mapGetters("Review", ["getUserReviews", "getUserPostedReviews"])
  },
  methods: {
    ...mapActions("Review", ["fetchUserReviews", "fetchUserPostedReviews"]),

    createPagination(data) {
      let pagination = {
        currentPage: data.current_page,
        lastPage: data.last_page,
        nextPage: data.next_page_url,
        prevPage: data.prev_page_url
      };
      this.pagination = pagination;
    },
    async fetchPaginatedReviews(url) {
      this.url_received = url;
      console.log(this.url_received);

      await this.fetchUserReviews(this.url_received);
      this.userreviews = this.getUserReviews.data;
      this.createPagination(this.getUserReviews);
    },
    async fetchPaginatedPostedReviews(url) {
      this.url_given = url;

      await this.fetchUserPostedReviews(this.url_given);
      this.userpostedreviews = this.getUserPostedReviews.data;
      this.createPagination(this.getUserPostedReviews);
    },
    given() {
      this.mode = "given";
      this.isActive = "given";
    },
    received() {
      this.mode = "received";
      this.isActive = "received";
    }
  },

  async mounted() {
    // Make network request if the data is empty
    if (this.getUserReviews.length === 0) {
      await this.fetchUserReviews(this.url_received);

      this.userreviews = this.getUserReviews.data;
      this.createPagination(this.getUserReviews);
    } else {
      this.userreviews = this.getUserReviews.data;
      this.createPagination(this.userreviews);
    }

    // Make network request if the data is empty
    if (this.getUserPostedReviews.length === 0) {
      await this.fetchUserPostedReviews(this.url_given);

      this.userpostedreviews = this.getUserPostedReviews.data;
      this.createPagination(this.getUserPostedReviews);
    } else {
      this.userpostedreviews = this.getUserPostedReviews.data;
      this.createPagination(this.userpostedreviews);
    }
  }
};
</script>

<style></style>
