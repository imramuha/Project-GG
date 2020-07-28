<template>
  <div class="profile">
    <div class="profileHeader">
      <div class="profileHeaderView">
        <div class="profileHeaderImage" v-if="friend.image">
          <img :src="friend.image" />
        </div>
        <div class="profileHeaderImage" v-else>
          <img src="@/assets/images/profile.jpeg" />
        </div>
      </div>
      <div class="profileHeaderData">
        <div>
          <h1>
            {{ friend.username }} <span>{{ this.relation.name }}</span>
          </h1>
          <p>{{ friend.email }}</p>
          <p>BIO: {{ friend.id }}</p>
        </div>
        <div class="profileHeaderScore">
          <div
            class="profileHeaderScorebar"
            v-bind:style="{ height: '100%', width: reviewscore + '%' }"
          ></div>
          <div v-if="reviewscore > 0" class="profileHeaderScorePercentage">
            {{ reviewscore.toFixed(2) }} %
          </div>
          <div v-else class="profileHeaderScoreEmpty">
            <span>You haven't received any reviews yet.</span>
          </div>
        </div>
      </div>
      <div class="profileHeaderButtons">
        <div class="profileHeaderReport">
          <button disabled>Report</button>
        </div>
        <div class="profileHeaderRelation">
          <button @click="update('friends')" v-if="this.activeButton == ''">
            Add Friend
          </button>
          <button
            @click="update('cancel')"
            v-if="this.activeButton == 'pending_first_second'"
          >
            Cancel request
          </button>
          <button
            @click="update('accept')"
            v-if="this.activeButton == 'pending_second_first'"
          >
            Accept request
          </button>
          <button
            @click="update('deny')"
            v-if="this.activeButton == 'pending_second_first'"
          >
            Deny request
          </button>
          <button
            @click="update('unfriend')"
            v-if="this.activeButton == 'friends'"
          >
            Unfriend
          </button>
          <button
            @click="update('block')"
            v-if="
              this.activeButton == 'block_second_first' ||
                this.activeButton == ''
            "
          >
            Block
          </button>
          <button
            @click="update('unblock')"
            v-if="
              this.activeButton == 'block_first_second' ||
                this.activeButton == 'block_both' ||
                this.activeButton == 'block_second_first'
            "
          >
            Unblock
          </button>
        </div>
      </div>
    </div>
    <div class="profileGames">
      <div class="profileGamesNav">
        <button
          v-on:click="fetchPaginatedGames(games_pagination.prevPage)"
          :disabled="!games_pagination.prevPage"
        >
          <i class="fa fa-arrow-left" aria-hidden="true"></i>
        </button>
      </div>
      <ProfileGameCard
        v-for="game in games"
        v-bind:key="game.id"
        :game="game"
      />
      <div class="profileGamesNav">
        <button
          v-on:click="fetchPaginatedGames(games_pagination.nextPage)"
          :disabled="!games_pagination.nextPage"
        >
          <i class="fa fa-arrow-right" aria-hidden="true"></i>
        </button>
      </div>
    </div>
    <div class="profileReviews">
      <div class="profileReviewsSection">
        <div class="profileReviewsNav">
          <button
            v-on:click="fetchPaginatedReviews(reviews_pagination.prevPage)"
            :disabled="!reviews_pagination.prevPage"
          >
            <i class="fa fa-arrow-up" aria-hidden="true"></i>
          </button>
        </div>
        <ProfileReviewCard
          v-for="review in reviews"
          v-bind:key="review.id"
          :review="review"
        />
        <div class="profileReviewsNav">
          <button
            v-on:click="fetchPaginatedReviews(reviews_pagination.nextPage)"
            :disabled="!reviews_pagination.nextPage"
          >
            <i class="fa fa-arrow-down" aria-hidden="true"></i>
          </button>
        </div>
      </div>

      <ReviewInput :id="friend.id" />
    </div>
  </div>
</template>

<script>
import { getFriend, getRelation } from "@/services/friend.api";
import { updateRelation } from "@/services/user.api";

import { mapActions, mapGetters } from "vuex";

import ReviewInput from "@/components/ReviewInput";
import ProfileGameCard from "@/components/profile/ProfileGameCard";
import ProfileReviewCard from "@/components/profile/ProfileReviewCard";

export default {
  components: { ReviewInput, ProfileGameCard, ProfileReviewCard },
  props: ["data"],
  data() {
    return {
      friend: [],
      relation: [],
      activeButton: "",
      reviewscore: 0,
      reviews: [],
      reviews_url: "/api/frontend/profilereviews/",
      reviews_pagination: [],
      games: [],
      games_url: "/api/frontend/profilegames/",
      games_pagination: [],
    };
  },
  computed: {
    ...mapGetters("Game", ["getProfileGames"]),
    ...mapGetters("Review", ["getProfileReviews"]),
  },
  methods: {
    ...mapActions("Game", ["fetchProfileGames"]),
    ...mapActions("Review", ["fetchProfileReviews"]),

    createGamesPagination(data) {
      let pagination = {
        currentPage: data.current_page,
        lastPage: data.last_page,
        nextPage: data.next_page_url,
        prevPage: data.prev_page_url,
      };
      this.games_pagination = pagination;
    },
    createReviewsPagination(data) {
      let pagination = {
        currentPage: data.current_page,
        lastPage: data.last_page,
        nextPage: data.next_page_url,
        prevPage: data.prev_page_url,
      };
      this.reviews_pagination = pagination;
    },
    async fetchPaginatedGames(url) {
      this.games_url = url;
      console.log(url);

      console.log(this.games_url);

      await this.fetchProfileGames(this.games_url);
      this.games = this.getProfileGames.data;
      this.createGamesPagination(this.getProfileGames);
    },
    async fetchPaginatedReviews(url) {
      this.reviews_url = url;
      console.log(url);

      console.log(this.reviews_url);

      await this.fetchProfileReviews(this.reviews_url);
      this.reviews = this.getProfileReviews.data;
      this.createReviewsPagination(this.getProfileReviews);
    },
    async update(data) {
      // make a call and send the data ->
      let relationData = {
        relation: data,
        profile_id: this.friend.id,
      };
      try {
        await updateRelation(relationData).then((response) => {
          this.$store
            .dispatch("notification", {
              message: response.data[0].response,
            })
            .then(() => {
              //this.$router.push('dashboard');
            })
            .catch((errors) => {
              console.log(errors);
            });
        });
      } catch (error) {
        console.log(error);
      }
    },
  },
  async mounted() {
    try {
      const response = await getFriend(this.data);
      this.friend = response.data.user[0];

      console.log(response.data);
      var score = 0;

      // gets the average score of all the reviews
      response.data.reviews.map(function(value) {
        score += parseFloat(value.score);
      });

      console.log(score);

      this.reviewscore = score / response.data.reviews.length;

      console.log(this.reviewscore);

      //console.log(this.friend.id);
    } catch (error) {
      console.log(error);
    }
    try {
      const response = await getRelation(this.data);
      console.log(response);
      this.relation = response.data[0];
      console.log(this.relation);

      this.activeButton = this.relation.name;

      console.log(this.activeButton);

      //console.log(this.friend.id);
    } catch (error) {
      console.log(error);
    }

    if (this.getProfileReviews.length == 0) {
      let url = this.reviews_url + this.friend.id;
      await this.fetchProfileReviews(url);

      this.reviews = this.getProfileReviews.data;
      console.log(this.reviews);
      this.createReviewsPagination(this.getProfileReviews);
    } else {
      this.reviews = this.getProfileReviews.data;
      this.createReviewsPagination(this.getProfileReviews);
      //this.createGamesPagination(this.reviews);
    }

    if (this.getProfileGames.length == 0) {
      let url = this.games_url + this.friend.id;
      await this.fetchProfileGames(url);

      this.games = this.getProfileGames.data;
      this.createGamesPagination(this.getProfileGames);
    } else {
      this.games = this.getProfileGames.data;
      // this.createGamesPagination(this.getgames);
      this.createGamesPagination(this.getProfileGames);
    }
  },
};
</script>

<style></style>
