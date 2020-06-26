<template>
  <div class="postPage">
    <div class="postPageContentContainer">
    <div class="postPageContent">
      <a @click="onPostCardClick" v-on:click="emitToPosts">
        <div class="postcardContentHeader">
          <h1>{{ post.title }}</h1>
        </div>
        <div class="postcardContentBody">
          <p>{{ post.date }}02/05/2002 - {{ post.liked_posts.length }}</p>
          <p>
            This is the post content, that will be added later on during this
            project
          </p>
        </div>
      </a>
      <div class="postcardContentFooter">
        <p>Comments (2)</p>
        <p>Report</p>
      </div>
    </div>
      <div class="postPageImage">
      <div v-if="post.image">
        <img :src="post.image" />
      </div>
      <div v-else>
        <img src="@/assets/images/post.png" />
      </div>
    </div>
    </div>
    <div v-if="post.user_liked != true" class="postcardStats">
      <button type="button" @click="gg">GG</button>
      <p>{{ post.liked_posts.length }}</p>
    </div>
    <div v-else class="postcardStats">
      <p>{{ post.liked_posts.length }}</p>
      <button class="likeButtonActive" type="button" @click="gg">uGG</button>
    </div>
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
//import CommentCard from "@/components/CommentCard";
import { getPost, postComment } from "@/services/forum.api";

export default {
  //components: { CommentCard },
  props: ["data"],
  data() {
    return {
      post: [],
      comments: [],
      comment: null,
      user_id: null,
      likes: null,
    };
  },
  async mounted() {
    try {
      const response = await getPost(this.data);
      this.post = response.data[0];
      this.comments = response.data[0].comments;
      this.likes = this.post.liked_posts.length;
      console.log(this.post);
    } catch (error) {
      console.log(error);
    }
  },
  methods: {
    async onSubmit() {
      let comment = {
        post_id: this.post.id,
        comment: this.comment,
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
    },
  },
};
</script>

<style></style>
