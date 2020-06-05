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

      
        <label for="image">image:</label>
       <div v-if="!image">
          <h2>Select an image</h2>
          <input accept="image/*" type="file" @change="onImageChange">
        </div>
        <div v-else>
          <img :src="image" />
          <button @click="removeImage">Remove image</button>
        </div>
    

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
      image: '',
    };
  },
  methods: {
    async onSubmit() {
      let post = {
        title: this.title,
        subtitle: this.subtitle,
        text: this.text,
        image: this.image,
      };

      let config = {
        header: {
            'Content-Type': 'multipart/form-data'
        }
      }

      console.log(this.image)

      try {
        let response = await createPost(post, config);
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
    },
    onImageChange(e) {
        let files = e.target.files || e.dataTransfer.files;
        if (!files.length)
            return;
        this.createImage(files[0]);
        console.log(files[0])
    },
    createImage(file) {
        let reader = new FileReader();
        let vm = this;
        reader.onload = (e) => {
            vm.image = e.target.result;
        };
        reader.readAsDataURL(file);
    },
    removeImage: function () {
      this.image = '';
    }
  }
};
</script>

<style scoped></style>
