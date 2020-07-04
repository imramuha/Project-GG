<template>
    <div class="profileReviewCard">
        <div class="profileReviewCardImage">
            <img :src="review.reviewer.image" />
        </div>
        <div class="profileReviewCardUserInfo">
            <p>{{ review.reviewer.username }}:
                <span>{{review.comment}}</span>
            </p>
        </div>
        <div class="profileReviewCardScore">
            <p>{{review.score}}</p>
        </div>
    </div>
</template>
<script>
export default {
    name: "ProfileReviewCard",
    props: {
        review: {
            type: Object,
            default: () => {
                return {};
            }
        }
    }
};
</script>
<style scoped></style>
