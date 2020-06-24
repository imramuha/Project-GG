<template>
    <div class="userEditForm">
        <div class="userEditFormHeader">
            <h1>EDIT PROFILE</h1>
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

                <button type="submit">Update</button>
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
            image: null
        };
    },
    async mounted() {
        try {
            await getMe().then(response => {
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
                image: this.image
            };

            try {
                let response = await editUser(userData);
                console.log(response);

                this.email = null;
                this.image = null;

                //console.log(this.friend.id);
            } catch (error) {
                console.log(error);
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
            reader.onload = e => {
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function() {
            this.image = "";
        }
    }
};
</script>

<style></style>
