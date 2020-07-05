<template>
  <div class="postPage">
    <div class="postPageContentContainer">
      <div class="postPageContent">
        <div class="postPageContentHeader">
          <h1>{{ post.title }}</h1>
        </div>
        <div class="postPageContentBody">
          <p>{{ post.date }}02/05/2002</p>
          <p>
            This is the post content, that will be added later on during this
            project
          </p>
        </div>
        <div class="postPageContentFooter">
          <div v-if="post.user_liked != true">
            <button type="button" @click="gg">GG</button>
            <p>{{ post.liked_posts.length }}</p>
          </div>
          <div v-else>
            <p>{{ post.liked_posts.length }}</p>
            <button class="likeButtonActive" type="button" @click="gg">
              uGG
            </button>
          </div>
          <p>Comments (2)</p>
          <p>Likes({{ post.liked_posts.length }})</p>
          <button>Report</button>
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
    <div class="postPageCommentsContainer">
      <div class="postPageComments">
        <CommentCard
          v-for="comment in comments"
          v-bind:key="comment.id"
          :comment="comment"
        />
      </div>
      <form @submit.prevent="onSubmit">
        <label for="comment">Comment</label>
        <input id="comment" v-model="comment" />

        <button type="submit">Comment</button>
      </form>
    </div>
  </div>
</template>

<script>
import CommentCard from "@/components/CommentCard";
import { getPost, postComment } from "@/services/forum.api";
import { likePost } from "@/services/forum.api";

export default {
  components: { CommentCard },
  props: ["data"],
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
      const response = await getPost(this.data);
      this.post = response.data;
      this.comments = response.data.comments;
      console.log(this.comments);
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
    },
    async gg() {
      let data = {
        post_id: this.post.id
      };

      try {
        await likePost(data).then(() => {
          getPost(this.post.id).then(response => {
            console.log("this");
            this.post = response.data;
          });
        });
      } catch (error) {
        console.log(error);
      }
    }
  }
};
</script>

<style></style>
