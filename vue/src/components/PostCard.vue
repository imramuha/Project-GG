<template>
  <div class="postCard">
    <div @click="onPostCardClick" v-on:click="emitToPosts" class="postcardImg">
      <div v-if="post.image">
        <img :src="post.image" />
      </div>
      <div v-else>
        <img src="@/assets/images/post.png" />
      </div>
    </div>
    <div class="postcardContent">
      <a @click="onPostCardClick" v-on:click="emitToPosts">
        <div class="postcardContentHeader">
          <h2>{{ post.title }}</h2>
        </div>
        <div class="postcardContentBody">
          <p>
            {{ post.created_at | formatDate }}
          </p>
          <p>
            {{ post.subtitle }}
          </p>
        </div>
      </a>
      <div class="postcardContentFooter">
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
    <div v-if="post.user_liked != true" class="postcardStats">
      <button type="button" @click="gg">GG</button>
      <p>{{ post.liked_posts.length }}</p>
    </div>
    <div v-else class="postcardStats">
      <p>{{ post.liked_posts.length }}</p>
      <button class="likeButtonActive" type="button" @click="gg">uGG</button>
    </div>
  </div>
</template>
<script>
import { likePost } from "@/services/forum.api";

export default {
  name: "PostCard",
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

          console.log(this.childMessage);

          this.emitToPosts();
        });
      } catch (error) {
        console.log(error);
      }
    },
    onPostCardClick() {
      this.childMessage = {
        component: "PostCard",
        id: this.post.id
      };
    },
    emitToPosts() {
      this.$emit("emitToPosts", this.childMessage);
    }
  }
};
</script>
<style scoped></style>
