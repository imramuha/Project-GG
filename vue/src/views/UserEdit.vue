<template>
  <div class="userEditForm">
    <div class="userEditFormHeader">
      <h1>EDIT PROFILE</h1>
       <p v-if="errors.length">
        <b>Please correct the following error(s):</b>
        <ul>
          <li v-for="error in errors" v-bind:key="error" >{{ error }}</li>
        </ul>
      </p>
    </div>
    <div class="userEditFormBody">
      <form @submit.prevent="onSubmit">
        <label for="email">email</label>
        <input id="email" v-model="email" />

        <label for="image">image</label>
        <div class="userEditFormUpload" v-if="!image">
          <input accept="image/*" type="file" @change="onImageChange" />
        </div>
        <div class="userEditFormUpload" v-else>
          <img class="userEditFormImage" :src="image" />
          <button @click="removeImage">Remove image</button>
        </div>
           <div class="formButtons">
          <button class="formButtonsCancel" @click="cancel">Cancel</button>
          <button type="submit">Update</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { getMe, editUser } from "@/services/user.api";

export default {
  data() {
    return {
      user: [],
      email: null,
      image: null,
      errors: [],
    };
  },
  async mounted() {
    try {
      await getMe().then((response) => {
        this.email = response.data.user[0].email;
        this.image = response.data.user[0].image;

        this.user = response.data.user[0];
        console.log(this.user);
      });
    } catch (error) {
      console.log(error);
    }
  },
  methods: {
    async onSubmit() {
      let userData = {
        email: this.email,
        image: this.image,
      };

      try {
        this.errors = [];
        if(!this.email) {
          this.errors.push('Email is required!');

        } if(!this.image) {
            this.errors.push('Please insert an image!');

        } else if (this.image && this.email) {
          await editUser(userData).then((response) => {
            this.$store
              .dispatch("notification", {
                message: response.data[0].response,
              })
              .then(() => {
                this.emitToDashboard('feed')
              })
              .catch((errors) => {
                console.log(errors);
              });
            this.email = null;
            this.image = null;
        });
      }

      } catch (errors) {
        let err = errors.response.data.errors;
         if(err.email) {
            this.errors.push(err.email[0] )
          }
          if(err.image) {
            this.errors.push(err.image[0] )
          }
      }
    },
    onImageChange(e) {
      let files = e.target.files || e.dataTransfer.files;
      if (!files.length) return;
      this.createImage(files[0]);
      console.log(files[0]);
    },
    createImage(file) {
      let reader = new FileReader();
      let vm = this;
      reader.onload = (e) => {
        vm.image = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    removeImage: function() {
      this.image = "";
    },
    emitToDashboard(component) {
      this.$emit("emitToDashboard", component);
    },
    cancel() {
      this.emitToDashboard('feed')
    }
  },
};
</script>

<style></style>
