<template>
    <div class="postCard">
        <a
            @click="onPostCardClick"
            v-on:click="emitToPosts"
        >
            <div class="postcardImg">
                <img :src="post.image" />
            </div>
            <div class="postcardContent">
                <div class="postcardContentHeader">
                    <h1>{{ post.title }}</h1>
                </div>
                <div class="postcardContentBody">
                    <p>{{ post.date }}</p>
                    <p>
                        This is the post content, that will be added later on during this
                        project
                    </p>
                </div>
                <div class="postcardContentFooter">
                    <p>Comments (2)</p>
                    <p>Report</p>
                </div>
            </div>
            <div class="postcardStats">
                <button type="button" @click="gg">GG</button>
                <p>{{ post.liked_posts.length }}</p>
                <button type="button" @click="ugg">uGG</button>
            </div>
        </a>
    </div>
</template>
<script>
export default {
    name: "PostCard",
    props: {
        post: {
            type: Object,
            default: () => {
                return {};
            }
        }
    },
    data() {
        return {
            childMessage: ""
        };
    },
    methods: {
        gg() {
            console.log("you just GG'd this post :)");
        },
        ugg() {
            console.log("you just uGG'd this post :(");
        },
        onPostCardClick() {
            this.childMessage = {
              component: "PostCard",
              id: this.post.id,
            }
        },
        emitToPosts() {
            this.$emit("emitToPosts", this.childMessage);
        }
    }
};
</script>
<style scoped></style>
