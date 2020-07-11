<template>
  <div class="postPage">
    <div class="postPageContentContainer">
      <div class="postPageContentHeader">
        <div class="postPageContent">
          <h1>{{ post.title }}<span>[ by <span>{{ post.user.username}}</span> created at <span>{{ post.created_at | formatDateTime }}</span> ]</span></h1>
          <h2>{{ post.subtitle }}</h2>
          <p> {{ post.text }} </p>
        
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
      <div class="postPageContentFooter">
        <div class="postPageContentFooterButtons">
          <p>
            Likes [ <span>{{ post.liked_posts.length }}</span> ]
          </p>
          <p>
            Comments [ <span>{{ comments.length }}</span> ]
          </p>
                    <button class="postPageReport" disabled>Report</button>
          <div class="postPageLike" v-if="post.user_liked != true">
            <button type="button" @click="gg">GG</button>
          </div>
          <div class="postPageUnlike" v-else>
            <button type="button" @click="gg">
              uGG
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="postPageCommentsContainer">
      <div class="postPageComments">
        <h1>Comments</h1>
        <CommentCard
          v-for="comment in comments"
          v-bind:key="comment.id"
          :comment="comment"
        />
      </div>
      <form @submit.prevent="onSubmit">
        <label for="comment">Comment</label>        
        <input id="comment" v-model="comment" />

        <p v-if="errors.length">
          <b>Please correct the following error(s):</b>
          <ul>
            <li v-for="error in errors" v-bind:key="error" >- {{ error }}</li>
          </ul>
        </p>

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
      likes: null,
      errors: [],
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
        comment: this.comment,
      };
      try {
        this.errors = [];
        if(!this.comment) {
            this.errors.push('Please you have to add a comment.');

        } else if (this.comment) {
          await postComment(comment).then((response)=> {
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
            this.post_id = null;
          });
          
        }
        //console.log(this.friend.id);
      } catch (errors) {
         let err = errors.response.data.errors;
         if(err.comment) {
            this.errors.push(err.comment[0] )
          }
      }
    },
    async gg() {
      let data = {
        post_id: this.post.id,
      };

      try {
        await likePost(data).then((response) => {
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

          getPost(this.post.id).then((response) => {
            this.post = response.data;
          });
        });
      } catch (error) {
        console.log(error);
      }
    },
  },
};
</script>

<style></style>
