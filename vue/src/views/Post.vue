<template>
  <div>
    <ul>
      <li>{{ post.id }}</li>
      <li>{{ post.title }}</li>
      <li>{{ post.date }}</li>
    </ul>
    <CommentCard v-for="comment in comments" v-bind:key="comment.id" :comment="comment" />
  </div>
</template>

<script>
import CommentCard from "@/components/CommentCard";
import { getPost } from "@/services/forum.api";

export default {
  components: { CommentCard },
  props: ["id"],
  data() {
    return {
      post: [],
      comments: [],
    };
  },
  created() {},
  async mounted() {
        try {
            const response = await getPost(this.id);
            this.post = response.data[0];
            this.comments = response.data[0].comments;
            console.log(this.post);

        } catch (error) {
            console.log(error);
        }
    },
};
</script>

<style></style>
