<template>
  <div>
    <ul>
      <li>{{ post.id }}</li>
      <li>{{ post.title }}</li>
      <li>{{ post.date }}</li>
      <li>GG'd: {{ this.likes }}</li>
    </ul>
    <form class="comment-form" @submit.prevent="onSubmit">
      <p>
        <label for="comment">Comment:</label>
        <input id="comment" v-model="comment" placeholder="comment" />
      </p>

      <p>
        <input type="submit" value="Submit" />
      </p>
    </form>
    <CommentCard
      v-for="comment in comments"
      v-bind:key="comment.id"
      :comment="comment"
    />
  </div>
</template>

<script>
import CommentCard from "@/components/CommentCard";
import { getPost, postComment } from "@/services/forum.api";

export default {
  components: { CommentCard },
  props: ["id"],
  data() {
    return {
      post: [],
      comments: [],
      comment: null,
      user_id: null,
      likes: null
    };
  },
  async mounted() {
    try {
      const response = await getPost(this.id);
      this.post = response.data[0];
      this.comments = response.data[0].comments;
      this.likes = this.post.liked_posts.length
      console.log(this.post);
    } catch (error) {
      console.log(error);
    }
  },
  methods: {
    async onSubmit() {
      let comment = {
        post_id: this.post.id,
        comment: this.comment
      };
      try {
        let response = await postComment(comment);
        console.log(comment);
        console.log(response);

        this.comment = null;
        this.post_id = null;

        //console.log(this.friend.id);
      } catch (error) {
        console.log(error);
      }
    }
  }
};
</script>

<style></style>
