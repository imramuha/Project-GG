<template>
  <div class="contentHeader">
    <div v-if="loading" class="ldsContainer">
      <div class="ldsRipple">
        <div></div>
        <div></div>
      </div>
    </div>

    <div class="userImage" v-else-if="user.image && !loading">
      <img :src="user.image" />
    </div>
    <div v-else-if="!user.image && !loading" class="userImage">
      <img src="@/assets/images/profile.jpeg" />
    </div>

    <div v-if="!loading" class="userDataContainer">
      <div class="userData">
        <div class="userDataLeft">
          <h1>{{ user.username }}</h1>
          <p>
            Likes to swim a lot
            <!--{{ user.line }}-->
          </p>
          <p v-if="user.status">{{ user.status.name }}</p>
        </div>
        <div class="userDataRight">
          <a v-on:click="onEditClick" to="/useredit">
            <button>Edit</button>
          </a>
        </div>
      </div>

      <div class="userReviewScore">
        <div
          class="userReviewScoreBar"
          v-bind:style="{ height: '100%', width: reviewscore + '%' }"
        ></div>
        <div v-if="reviewscore > 0" class="userReviewScorePercentage">
          {{ reviewscore.toFixed(2) }} %
        </div>
        <div v-else class="userReviewScoreEmpty">
          <span>You haven't received any reviews yet.</span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { getMe } from "@/services/user.api";

export default {
  name: "ProfileHeader",
  data() {
    return {
      user: [],
      reviewscore: 0,
      loading: true
    };
  },
  async mounted() {
    try {
      await getMe().then(response => {
        this.user = response.data.user[0];

        var score = 0;

        // gets the average score of all the reviews
        response.data.reviews.map(function(value) {
          score += parseFloat(value.score);
        });

        this.reviewscore = score / response.data.reviews.length;

        this.loading = false;
      });
    } catch (error) {
      console.log(error);
    }
  },
  methods: {
    onEditClick() {
      let value = {
        component: "UserEdit"
      };
      this.emitToOverscreen(value);
    },
    emitToOverscreen(value) {
      this.$emit("emitToOverscreen", value);
    }
  }
};
</script>

<style scoped>
.friendlist img {
  width: 50px;
  height: 50px;
}
</style>
