<template>
    <div class="contentHeader">
        <div class="userImage">

<router-link to="/user" class="button"> <img :src="user.image" /></router-link>
        </div>

        <div class="userDataContainer">
            <div class="userData">
                <div class="userDataLeft">
                    <h1> {{ user.username }}</h1>
                    <p> Likes to swim a lot<!--{{ user.line }}--> </p>
                    <p> {{ user.status.name }} </p>
                </div>
                <div class="userDataRight">
                         <router-link to="/useredit"><button>EDIT</button></router-link>
                </div>
            </div>

            <div class="userReviewScore">
                <p>Your average review score out of 100: {{ reviewscore }}</p>
            </div>
        </div>
    </div>
</template>

<script>

import { getMe } from "@/services/user.api";

export default {
    name: "ProfileHeader",
    data() {
        return {
            user: [],
            reviewscore: 0
        };
    },
    async mounted() {
        try {
            await getMe().then(response => {
                this.user = response.data.user[0];
                console.log(this.user);

                var score = 0;

                // gets the average score of all the reviews
                response.data.reviews.map(function(value) {
                    score += parseFloat(value.score);
                });

                this.reviewscore = score / response.data.reviews.length;
            });
        } catch (error) {
            console.log(error);
        }
    }
};
</script>

<style scoped>
.friendlist img {
    width: 50px;
    height: 50px;
}
</style>
