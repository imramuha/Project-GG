<template>
  <div class="profileReviewInput">
    <form @submit.prevent="onSubmit">
      <label for="comment">Review</label>
      <textarea id="comment" v-model="comment" placeholder="review ..." />

      <label for="rating">Rating | 0 - 100</label>
      <input
        id="rating"
        type="range"
        v-model="rating"
        min="0"
        value="50"
        max="100"
      />
      <p v-if="errors.length">
        <b>Please correct the following error(s):</b>
        <ul>
          <li v-for="error in errors" v-bind:key="error" >- {{ error }}</li>
        </ul>
      </p>
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
      errors: [],
    };
  },
  methods: {
    async onSubmit() {
      this.errors = [];

       if(!this.comment) {
          this.errors.push('Please add a review!');

      } if(!this.rating) {
          this.errors.push('Please select a rating!');
      } else if (this.id && this.comment && this.rating) {

        let userReview = {
          id: this.id,
          comment: this.comment,
          rating: this.rating
        };
     
          await reviewUser(userReview).then((response) => {
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
            this.comment = null;
            this.rating = null;
          }).catch((errors) => {
            console.log(errors.response.data.errors);
            if(errors) {
                const err = errors.response.data.errors;
              console.log(err);
              if(err.comment) {
                this.errors.push(err.comment[0])
              } if(err.rating) {
                this.errors.push( err.rating[0])
              } if (err.error) {
                console.log(err.error[0]);
                this.errors.push( err.error[0])
              }
            }

           
        });
      }
    }
  }
};
</script>
<style scoped></style>
