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
          >
            {{ reviewscore }} %
          </div>
        </div>
      </div>
      <div class="profileHeaderButtons">
        <div class="profileHeaderReport">
          <button disabled>Report</button>
        </div>
        <div class="profileHeaderRelation">
          <button @click="update('friends')" v-if="this.activeButton == ''">
            + Friend
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
        <i class="fa fa-arrow-left" aria-hidden="true"></i>
      </div>
      <ProfileGameCard
        v-for="game in games"
        v-bind:key="game.id"
        :game="game"
      />
      <div class="profileGamesNav">
        <i class="fa fa-arrow-right" aria-hidden="true"></i>
      </div>
    </div>
    <div class="profileReviews">
      <div class="profileReviewsSection">
        <ProfileReviewCard
          v-for="review in reviews"
          v-bind:key="review.id"
          :review="review"
        />
      </div>

      <ReviewInput :id="friend.id" />
    </div>
  </div>
</template>

<script>
import { getFriend, getRelation } from "@/services/friend.api";
import { updateRelation } from "@/services/user.api";
import { getProfileGames } from "@/services/game.api";
import { getProfileReviews } from "@/services/review.api";

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
      games: []
    };
  },
  methods: {
    async update(data) {
      // make a call and send the data ->
      let relationData = {
        relation: data,
        profile_id: this.friend.id
      };
      try {
        await updateRelation(relationData).then(response => {
          console.log(response);
        });
      } catch (error) {
        console.log(error);
      }
    }
  },
  async mounted() {
    console.log(this.data)
    try {
      const response = await getFriend(this.data);
      this.friend = response.data.user[0];

      var score = 0;

      // gets the average score of all the reviews
      response.data.reviews.map(function(value) {
        score += parseFloat(value.score);
      });

      this.reviewscore = score / response.data.reviews.length;

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
    try {
      const response = await getProfileReviews(this.friend.id);
      this.reviews = response.data.data;
    } catch (error) {
      console.log(error);
    }
    try {
      const response = await getProfileGames(this.friend.id);
      this.games = response.data.data;
      console.log(response.data);
    } catch (error) {
      console.log(error);
    }
  }
};
</script>

<style></style>
