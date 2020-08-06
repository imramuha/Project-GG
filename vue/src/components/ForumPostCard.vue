<template>
  <div class="forumPostCard">
    <div class="forumPostCardImage" v-if="post.image">
      <a @click="onForumPostCardClick">
        <img :src="post.image" />
      </a>
    </div>
    <div class="forumPostCardImage" v-else>
      <a @click="onForumPostCardClick">
        <img src="@/assets/images/post.png" />
      </a>
    </div>
    <div class="forumPostcardContent">
      <a @click="onForumPostCardClick">
        <div class="forumPostcardContentHeader">
          <h1>
            {{ post.title
            }}<span>[ created at {{ post.created_at | formatDate }}]</span>
          </h1>
        </div>
        <div class="forumPostcardContentBody">
          <p>
            {{ post.subtitle }}
          </p>
        </div>
      </a>
      <div class="forumPostcardContentFooter">
        <p>
          Likes (<span>{{ post.liked_posts.length }}</span
          >)
        </p>
        <p>
          Comments (<span>{{ post.comments.length }}</span
          >)
        </p>
      </div>
    </div>
    <div v-if="post.user_liked != true" class="forumPostCardStats">
      <button type="button" @click="gg">GG</button>
    </div>
    <div v-else class="forumPostCardStats">
      <button class="likeButtonActive" type="button" @click="gg">uGG</button>
    </div>
  </div>
</template>
<script>
import { likePost } from "@/services/forum.api";

export default {
  name: "ForumPostCard",
  props: {
    post: {
      type: Object,
      default: () => {
        return {};
      }
    }
  },
  data() {
    return {
      childMessage: ""
      //toggleLike: "liked",
    };
  },
  methods: {
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

          // emit to parent
          this.childMessage = {
            component: "remount"
          };

          this.emitToForum(this.childMessage);
        });
      } catch (error) {
        console.log(error);
      }
    },
    onForumPostCardClick() {
      this.childMessage = {
        component: "ForumPostCard",
        id: this.post.id
      };

      this.emitToForum(this.childMessage);
    },
    emitToForum(value) {
      this.$emit("emitToForum", value);
    }
  }
};
</script>
<style scoped></style>
