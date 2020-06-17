<template>
    <div class="postsboard">
        <a><button>Given</button></a>
        <a><button>Received</button></a>

        <div class="posts">

            <ReviewCard v-for="userreview in userreviews" v-bind:key="userreview.id" :review="userreview" />
        </div>
        <div class="postsNav">
            <button v-on:click="fetchPaginatedReviews(pagination.prevPage)" :disabled="!pagination.prevPage">Previous</button>
            <p>Page {{ pagination.currentPage }} of {{ pagination.lastPage }}</p>
            <button v-on:click="fetchPaginatedReviews(pagination.nextPage)" :disabled="!pagination.nextPage" >Next</button>
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
            url_received: "/api/frontend/userreviews",
            url_given: "/api/frontend/userpostedreviews",
            pagination: [],
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
                prevPage: data.prev_page_url,
            }
            this.pagination = pagination;
        },
        async fetchPaginatedReviews(url) {
            this.url = url;

            await this.fetchUserReviews(this.url);
            this.userreviews = this.getUserReviews.data;
            this.createPagination(this.getUserReviews)
        }
    },

    async mounted() {
        // Make network request if the data is empty
        if (this.getUserReviews.length === 0) {

            await this.fetchUserReviews(this.url);

            this.userreviews = this.getUserReviews.data;
            this.createPagination(this.getUserReviews)

            console.log(this.pagination);
        } else {
            this.userreviews = this.getUserReviews.data;
            this.createPagination(this.userreviews)
        }
    }
};
</script>

<style></style>
