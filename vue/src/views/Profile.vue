<template>
  <div class="profile">
    <div v-if="loadingProfile" class="ldsContainer">
      <div class="ldsRipple">
        <div></div>
        <div></div>
      </div>
    </div>
    <div v-else class="profileHeader">
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
            {{ friend.username }} <span v-if="this.relation">{{ this.relation.name }}</span>
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
            <span>{{ friend.username }} hasn't received received any reviews yet.</span>
          </div>
        </div>
      </div>
      <div class="profileHeaderButtons">
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
        <div class="profileHeaderReport">
          <button @click="reportModal = true">Report</button>
          <div v-if="reportModal" class="ProfileHeaderReportModalContainer">
            <div class="ProfileHeaderReportModal">
              <h1>
                Report <span>{{ friend.username }}</span>
              </h1>
              <p v-if="errors.length">
                <b>Please correct the following error(s):</b>
                <ul>
                  <li v-for="error in errors" v-bind:key="error" >{{ error }}</li>
                </ul>
              </p>
              <form v-on:submit.prevent="report()">
                <label for="reason">Reason</label>
                <textarea v-model="reason" rows="5" placeholder="Enter your reason" type="textarea" name="reason" />


                <div class="reportFormButtons">
                  <button @click="reportModal = false">Cancel</button>
                  <button type="submit" >Submit</button>
                </div>
              </form>
            </div>
          </div>
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

      <div v-if="loadingGames" class="ldsContainer">
        <div class="ldsRipple">
          <div></div>
          <div></div>
        </div>
      </div>
      <ProfileGameCard
        v-else-if="!loadingGames && games"
        v-for="game in games"
        v-bind:key="game.id"
        :game="game"
      />
      <h1 v-if="!games.length && !loadingGames">
        User has no favorited Games.
      </h1>

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

        <div class="profileReviewsNavContainer">
          <div class="profileReviewsNav">
            <button
              v-on:click="fetchPaginatedReviews(reviews_pagination.prevPage)"
              :disabled="!reviews_pagination.prevPage"
            >
              <i class="fa fa-arrow-up" aria-hidden="true"></i>
            </button>
          </div>
          <div class="profileReviewsNav">
            <button
              v-on:click="fetchPaginatedReviews(reviews_pagination.nextPage)"
              :disabled="!reviews_pagination.nextPage"
            >
              <i class="fa fa-arrow-down" aria-hidden="true"></i>
            </button>
          </div>
        </div>

      <div class="profileReviewCardsContainer">
        <div v-if="loadingReviews" class="ldsContainer">
          <div class="ldsRipple">
            <div></div>
            <div></div>
          </div>
        </div>

        <ProfileReviewCard
          v-else-if="reviews && !loadingReviews"
          v-for="review in reviews"
          v-bind:key="review.id"
          :review="review"
        />

        <h1 v-if="!reviews.length && !loadingReviews">
          <span>User hasn't received any reviews yet.</span>
        </h1>
      </div>

      </div>

      <ReviewInput v-on:emitToProfile="getUserReviews" :id="friend.id" />
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
import { addReport } from "@/services/report.api";

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
      loadingProfile: true,
      loadingGames: true,
      loadingReviews: true,
      reportModal: false,
      errors: [],
      reason: null,
    };
  },
  computed: {
    ...mapGetters("Game", ["getProfileGames"]),
    ...mapGetters("Review", ["getProfileReviews"]),
  },
  methods: {
    ...mapActions("Game", ["fetchProfileGames"]),
    ...mapActions("Review", ["fetchProfileReviews"]),

    async getUserReviews() {
      if (!this.getProfileReviews.length) {
        let url = this.reviews_url + this.friend.id;
        await this.fetchProfileReviews(url);

        this.reviews = this.getProfileReviews.data;
        console.log(this.reviews);
        this.createReviewsPagination(this.getProfileReviews);
        this.loadingReviews = false;
      } else {
        this.reviews = this.getProfileReviews.data;
        this.createReviewsPagination(this.getProfileReviews);
        this.loadingReviews = false;
      }
    },
    async getUserGames() {
      if (!this.getProfileGames.length) {
        let url = this.games_url + this.friend.id;
        await this.fetchProfileGames(url);

        this.games = this.getProfileGames.data;
        this.createGamesPagination(this.getProfileGames);
        this.loadingGames = false;
      } else {
        this.games = this.getProfileGames.data;
        this.createGamesPagination(this.getProfileGames);
        this.loadingGames = false;
      }
    },
    emitToProfile() {
      this.$emit("emitToProfile");
    },
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
      this.loadingGames = false;
    },
    async fetchPaginatedReviews(url) {
      this.reviews_url = url;
      console.log(url);

      console.log(this.reviews_url);

      await this.fetchProfileReviews(this.reviews_url);
      this.reviews = this.getProfileReviews.data;
      this.createReviewsPagination(this.getProfileReviews);
      this.loadingReviews = false;
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
    async report() {
      this.errors = [];

      if(!this.reason) {
          this.errors.push('A reasoning is required!');

      } else if (this.reason) {

         let reportData = {
          reason: this.reason,
          type: 'profile',
          type_id: this.friend.id
        };

        await addReport(reportData).then((response) => {
          this.$store
            .dispatch("notification", {
              message: response.data[0].response,
            })
            .then(() => {
              this.reportModal = false;
            })
            .catch((errors) => {
              console.log(errors);
            });

          this.reason = null

        }).catch((errors) => {
          const err = errors.response.data.errors;
          if(err.reason) {
            console.log(err.reason)
            this.errors.push( err.reason[0] )
          }
        });
      
      }
    }
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
      this.loadingProfile = false;
    } catch (error) {
      console.log(error);
    }
    try {
      const response = await getRelation(this.data);

      this.relation = response.data[0];

      this.activeButton = this.relation.name;

      this.loadingRelation = false;
    } catch (error) {
      console.log(error);
    }

    this.getUserReviews();
    this.getUserGames();
  },
};
</script>

<style></style>
