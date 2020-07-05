<template>
  <div class="contentHeader">
    <div class="userImage">
      <div v-if="user.image">
        <img :src="user.image" />
      </div>
      <div v-else>
        <img src="@/assets/images/profile.jpeg" />
      </div>
    </div>

    <div class="userDataContainer">
      <div class="userData">
        <div class="userDataLeft">
          <h1>{{ user.username }}</h1>
          <p>
            Likes to swim a lot
            <!--{{ user.line }}-->
          </p>
          <p>Online</p>
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
        >
          {{ reviewscore }} %
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
      reviewscore: 0
    };
  },
  async mounted() {
    try {
      await getMe().then(response => {
        this.user = response.data.user[0];
        console.log(this.user);

        var score = 0;

        // gets the average score of all the reviews
        response.data.reviews.map(function(value) {
          score += parseFloat(value.score);
        });

        this.reviewscore = score / response.data.reviews.length;
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
