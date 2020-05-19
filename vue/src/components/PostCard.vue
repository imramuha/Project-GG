<template>
  <div class="post-card">
    <router-link :to="{ name: 'post', params: { id: post.id } }">
      <b-card-group rows>
        <b-card
          bg-variant="dark"
          img-src="https://placekitten.com/250/250"
          img-left
          text-variant="white"
          class="mb-3"
        >
          <b-card-title>{{ post.title }}</b-card-title>
          <b-card-text>{{ post.user_id }}</b-card-text>
          <b-card-text class="small text-muted">{{ post.date }}</b-card-text>

          <b-button variant="primary" type="button" class="ggButton" @click="gg"
            >GG</b-button
          >
        </b-card>
      </b-card-group>
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
      }
    }
  },
  methods: {
    gg() {
      console.log("this post is gg'd by logged in user");
    }
  }
};
</script>
<style scoped></style>
