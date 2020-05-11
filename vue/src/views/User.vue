<template>
  <div>
    <ul>
      <li>{{ me.id }}</li>
        <li>{{ me.username }}</li>
        <li>{{ me.email }}</li>
    </ul>
    <ReviewCard v-for="review in reviews" v-bind:key="review.id" :review="review" />
  </div>
</template>

<script>
import ReviewCard from "@/components/ReviewCard";
import { getMe } from "@/services/user.api";

export default {
  components: { ReviewCard },
  data() {
    return {
      me: [],
      reviews: [],
    };
  },
  created() {},
  async mounted() {
        try {
            const response = await getMe(this.id);
            this.me = response.data.user[0];
            //console.log(response.data.reviews)
            this.reviews = response.data.reviews;
            console.log(this.reviews);
            // console.log(this.me);
        } catch (error) {
            console.log(error);
        }
    },
};
</script>

<style></style>
