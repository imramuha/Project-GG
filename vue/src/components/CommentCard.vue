<template>
  <div class="commentCard">
    <div class="commentCardImage" v-if="comment.user.image">
      <img :src="comment.user.image" />
    </div>
    <div class="commentCardImage" v-else>
      <img src="@/assets/images/post.png" />
    </div>
    <p>
      <span
        >{{ comment.user.username }}
        <span>{{ comment.created_at | formatDate }}</span></span
      >{{ comment.comment }}
    </p>
  </div>
</template>
<script>
export default {
  name: "CommentCard",
  props: {
    comment: {
      type: Object,
      default: () => {
        return {};
      }
    }
  }
};
</script>
<style scoped></style>
