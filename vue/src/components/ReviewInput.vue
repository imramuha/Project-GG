<template>
  <div class="profileReviewInput">
    <form @submit.prevent="onSubmit">
        <label for="comment">Review</label>
        <textarea id="comment" v-model="comment" placeholder="review ..." />

        <label for="rating">Rating</label>
        <input id="rating" v-model="rating" placeholder="rating 1-100" />

        <button type="submit" value="Submit">Post</button>
    </form>
  </div>
</template>
<script>
import { reviewUser } from "@/services/friend.api";

export default {
  name: "ReviewInput",
  props: {
    id: Number
  },
  data() {
    return {
      comment: null,
      rating: null,
      errors: []
    };
  },
  methods: {
    async onSubmit() {
      let userReview = {
        id: this.id,
        comment: this.comment,
        rating: this.rating
      };
      try {
        let response = await reviewUser(userReview);
        console.log(userReview);
        console.log(response);

        this.comment = null;
        this.rating = null;

        //console.log(this.friend.id);
      } catch (error) {
        console.log(error);
      }
    }
  }
};
</script>
<style scoped></style>
