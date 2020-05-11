<template>
    <div class="post-card">
            <p>review input over here</p>
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
