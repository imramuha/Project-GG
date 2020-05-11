<template>
    <div class="post-card">
            <b-card-group rows>

                    <b-card-title>Review by: {{ review.reviewer.username }} - </b-card-title>
                    <b-card-text> comment: {{ review.comment }} - </b-card-text>
                    <b-card-text> score: {{ review.score }}</b-card-text>
            </b-card-group>
    </div>
</template>
<script>
export default {
    name: "ReviewCard",
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
<style scoped>

</style>
