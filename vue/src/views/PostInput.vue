<template>
  <div>
    <form class="review-form" @submit.prevent="onSubmit">
      <p>
        <label for="title">title:</label>
        <input id="title" v-model="title" placeholder="title" />
      </p>
        <p>
        <label for="subtitle">subtitle:</label>
        <input id="subtitle" v-model="subtitle" placeholder="subtitle" />
      </p>
        <p>
        <label for="text">text:</label>
        <input id="text" v-model="text" placeholder="text" />
      </p>

      <!--<p>
        <label for="rating">image:</label>
        <textarea id="rating" v-model="rating"></textarea>
      </p>-->

      <p>
        <input type="submit" value="Submit" />
      </p>
    </form>
  </div>
</template>
<script>
import { createPost } from "@/services/forum.api";

export default {
  name: "postInput",
  data() {
    return {
      title: null,
      subtitle: null,
      text: null,
      //image: null,
    };
  },
  methods: {
    async onSubmit() {
      let post = {
        title: this.title,
        subtitle: this.subtitle,
        text: this.text,
        image: null,
      };
      try {
        let response = await createPost(post);
        console.log(post);
        console.log(response);

        this.title = null;
        this.subtitle = null;
        this.text = null;
        this.image = null;

        //console.log(this.friend.id);
      } catch (error) {
        console.log(error);
      }
    }
  }
};
</script>

<style scoped></style>
