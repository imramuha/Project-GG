<template>
  <div class="postForm">
    <div class="postFormHeader">
      <h1>CREATE A POST</h1>
    </div>
    <div class="postFormBody">
    <form @submit.prevent="onSubmit">
     
        <label for="title">title</label>
        <input id="title" v-model="title" />
      
        <label for="subtitle">subtitle</label>
        <input id="subtitle" v-model="subtitle"/>
    
        <label for="text">text</label>
        <input id="text" type="textarea" v-model="text" />
  

      
      <label for="image">image</label>
       <div class="postFormUpload" v-if="!image">
          <input accept="image/*" type="file" @change="onImageChange">
        </div>
        <div class="postFormUpload" v-else>
          <img class="postFormImage" :src="image" />
          <button @click="removeImage">Remove</button>
        </div>
    
        <button type="submit">Create</button>

    </form>
    </div>
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
