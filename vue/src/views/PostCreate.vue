<template>
  <div class="postForm">
    <div class="postFormHeader">
      <h1>CREATE A POST</h1>
      <p v-if="errors.length">
        <b>Please correct the following error(s):</b>
        <ul>
          <li v-for="error in errors" v-bind:key="error" >{{ error }}</li>
        </ul>
      </p>
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
      errors: [],
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
      try {
        this.errors = [];
        if(!this.title) {
          this.errors.push('Title is required!');

        } if(!this.subtitle) {
            this.errors.push('Subtitle or Subject is also required!');

        } if(!this.text) {
            this.errors.push('Please enter some text to your post.');

        } else if (this.title && this.subtitle && this.text) {
          await createPost(post, config).then((response) => {
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

            
            this.title = null;
            this.subtitle = null;
            this.text = null;
            this.image = null;
          })          
        }
      } catch (errors) {
        let err = errors.response.data.errors;
        console.log(errors);
         if(err.title) {
            this.errors.push(err.title[0] )
          }
          if(err.subtitle) {
            this.errors.push(err.subtitle[0] )
          }
           if(err.text) {
            this.errors.push(err.text[0] )
          }
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
