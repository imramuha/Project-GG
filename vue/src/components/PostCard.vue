<template>
  <div class="postCard">
    <router-link :to="{ name: 'post', params: { id: post.id } }"
      >
      <div class="postcardImg">
        <img src="https://placekitten.com/250/250" />
      </div>
      <div class="postcardContent">
        <h1>{{ post.title }}</h1>
        <p>{{ post.date }}</p>
        <p>
          This is the post content, that will be added later on during this
          project
        </p>
      </div>
      <div class="postcardStats">
        <button type="button" @click="gg">GG</button>
        <p>{{ post.liked_posts.length }}</p>
        <button type="button" @click="ugg">uGG</button>
      </div>
    </router-link>
  </div>
</template>
<script>
export default {
  name: "PostCard",
  props: {
    post: {
      type: Object,
      default: () => {
        return {};
      },
    },
  },
  methods: {
    gg() {
      console.log("you just GG'd this post :)");
    },
    ugg() {
      console.log("you just uGG'd this post :(");
    },
  },
};
</script>
<style scoped></style>
