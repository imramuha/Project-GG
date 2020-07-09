<template>
  <div class="reviewCard">
    <div v-if="review.image" class="reviewCardImage">
      <img :src="review.image" />

      <div class="reviewCardContentHeader">
        <h1>
          {{ review.reviewer_id
          }}<span>{{ review.created_at | formatDateTime }}</span>
        </h1>
        <p>{{ review.comment }}</p>
      </div>
      <div v-if="review.score <= 49" class="reviewCardContentBody">
        <p class="reviewCarsScoreRed">{{ review.score }}</p>
      </div>
      <div v-else class="reviewCardContentBody">
        <p class="reviewCardScoreGreen">{{ review.score }}</p>
      </div>
    </div>
    <div v-else class="reviewCardImage">
      <img src="@/assets/images/profile.jpeg" />

      <div class="reviewCardContentHeader">
        <h1>
          {{ review.reviewer_id
          }}<span>{{ review.created_at | formatDateTime }}</span>
        </h1>
        <p>{{ review.comment }}</p>
      </div>
      <div v-if="review.score <= 49" class="reviewCardContentBody">
        <p class="reviewCardScoreRed">{{ review.score }}</p>
      </div>
      <div v-else class="reviewCardContentBody">
        <p class="reviewCardScoreGreen">{{ review.score }}</p>
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
      },
    },
  },
};
</script>
<style scoped></style>
