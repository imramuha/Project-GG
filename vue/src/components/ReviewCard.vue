<template>
  <div class="reviewCard">
    <router-link :to="{ name: 'post', params: { id: review.id } }"
      >
      <div class="reviewCardImg">
        <img src="https://placekitten.com/250/250" />
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
    </router-link>
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
