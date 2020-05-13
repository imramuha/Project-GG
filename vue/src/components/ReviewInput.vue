<template>
    <div>
        <form class="review-form" @submit.prevent="onSubmit">
            <p>
                <label for="comment">Comment:</label>
                <input id="comment" v-model="comment" placeholder="comment" />
            </p>

            <p>
                <label for="rating">Rating:</label>
                <textarea id="rating" v-model="rating"></textarea>
            </p>

            <p>
                <input type="submit" value="Submit" />
            </p>
        </form>
    </div>
</template>
<script>
import { reviewUser } from "@/services/friend.api";

export default {
    name: "ReviewInput",
    props: {
        id: Number
    },
    data() {
        return {
            comment: null,
            rating: null,
            errors: []
        };
    },
    methods: {
        async onSubmit() {
            let userReview = {
                id: this.id,
                comment: this.comment,
                rating: this.rating
            };
            try {
                let response = await reviewUser(userReview);
                console.log(userReview);
                console.log(response);

                this.comment = null;
                this.rating = null;

                //console.log(this.friend.id);
            } catch (error) {
                console.log(error);
            }
        }
    }
};
</script>
<style scoped>
</style>
