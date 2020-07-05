<template>
  <div class="reviewCard">
    <div class="reviewCardImg">
      <div v-if="review.image">
        <img :src="review.image" />
      </div>
      <div v-else>
        <img src="@/assets/images/profile.jpeg" />
      </div>
      Username/data
    </div>
    <div class="reviewCardContent">
      <div class="reviewCardContentHeader">
        <h1>{{ review.reviewer_id }}</h1>
      </div>
      <div class="reviewCardContentBody">
        <p>{{ review.comment }}</p>
        <p>
          {{ review.score }}
        </p>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "ReviewCard",
  props: {
    review: {
      type: Object,
      default: () => {
        return {};
      }
    }
  }
};
</script>
<style scoped></style>
