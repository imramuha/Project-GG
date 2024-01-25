<template>
  <div class="postPage">
    <div class="postPageContentContainer">
      <div class="postPageContentHeader">
        <div class="postPageContent">
          <h1>
            {{ post.title
            }}<span
              >[ by <span>{{ post.user.username }}</span> created at
              <span>{{ post.created_at | formatDateTime }}</span> ]</span
            >
          </h1>
          <h2>{{ post.subtitle }}</h2>
          <p>{{ post.text }}</p>
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
          <div class="postPageReport">
            <button @click="reportModal = true">Report</button>
            <div v-if="reportModal" class="postPageReportModalContainer">
              <div class="postPageReportModal">
                <h1>
                  Report post by <span>{{ post.user.username }}</span>
                </h1>
                <p v-if="reportErrors.length">
                  <b>Please correct the following error(s):</b>
                </p>

                <ul>
                  <li v-for="error in reportErrors" v-bind:key="error">
                    {{ error }}
                  </li>
                </ul>
                <form v-on:submit.prevent="report()">
                  <label for="reason">Reason</label>
                  <textarea
                    v-model="reason"
                    rows="5"
                    placeholder="Enter your reason"
                    type="textarea"
                    name="reason"
                  />

                  <div class="reportFormButtons">
                    <button @click="reportModal = false">Cancel</button>
                    <button type="submit">Submit</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
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
        </p>

        <ul>
          <li v-for="error in errors" v-bind:key="error">- {{ error }}</li>
        </ul>
        <button type="submit">Comment</button>
      </form>
    </div>
  </div>
</template>

<script>
import CommentCard from "@/components/CommentCard";
import { getPost, postComment } from "@/services/forum.api";
import { likePost } from "@/services/forum.api";
import { addReport } from "@/services/report.api";

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
      reportModal: false,
      reportErrors: [],
      reason: null
    };
  },
  async mounted() {
    try {
      this.getPostData(this.data);
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
        this.errors = [];
        if (!this.comment) {
          this.errors.push("Please you have to add a comment.");
        } else if (this.comment) {
          await postComment(comment).then(response => {
            this.$store
              .dispatch("notification", {
                message: response.data[0].response
              })
              .then(() => {
                console.log("comment was posted");
                this.getPostData(this.data);
              })
              .catch(errors => {
                console.log(errors);
              });

            this.comment = null;
            this.post_id = null;
          });
        }
        //console.log(this.friend.id);
      } catch (errors) {
        let err = errors.response.data.errors;
        if (err.comment) {
          this.errors.push(err.comment[0]);
        }
      }
    },
    async gg() {
      let data = {
        post_id: this.post.id
      };

      try {
        await likePost(data).then(response => {
          this.$store
            .dispatch("notification", {
              message: response.data[0].response
            })
            .then(() => {
              //this.$router.push('dashboard');
            })
            .catch(errors => {
              console.log(errors);
            });

          getPost(this.post.id).then(response => {
            this.post = response.data;
          });
        });
      } catch (error) {
        console.log(error);
      }
    },
    async getPostData(data) {
      const response = await getPost(data);
      this.post = response.data;
      this.comments = response.data.comments;
      this.likes = this.post.liked_posts.length;
    },
    async report() {
      this.reportErrors = [];

      if (!this.reason) {
        this.reportErrors.push("A reasoning is required!");
      } else if (this.reason) {
        let reportData = {
          reason: this.reason,
          type: "post",
          type_id: this.post.id
        };

        await addReport(reportData)
          .then(response => {
            this.$store
              .dispatch("notification", {
                message: response.data[0].response
              })
              .then(() => {
                this.reportModal = false;
              })
              .catch(errors => {
                console.log(errors);
              });

            this.reason = null;
          })
          .catch(errors => {
            const err = errors.response.data.errors;
            if (err.reason) {
              console.log(err.reason);
              this.reportErrors.push(err.reason[0]);
            }
          });
      }
    }
  }
};
</script>

<style></style>
