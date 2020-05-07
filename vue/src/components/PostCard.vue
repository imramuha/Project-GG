<template>
    <div class="post-card">
        <router-link :to="{ name: 'post', params: { id: post.id } }">
            <b-card-group rows>
                <b-card
                    bg-variant="dark"
                    img-src="https://placekitten.com/250/250"
                    img-left
                    text-variant="white"
                    class="mb-3"
                >
                    <b-card-title>{{ post.title }}</b-card-title>
                    <b-card-text>{{ post.user_id }}</b-card-text>
                    <b-card-text class="small text-muted">{{ post.date }}</b-card-text>
                    
                    <b-button variant="primary" type="button" class="ggButton" @click="gg" >GG</b-button>
                </b-card>
             
            </b-card-group>
        </router-link>
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
    methods: {
        gg() {
            console.log("this post is gg'd by logged in user")
        }
    }
};
</script>
<style scoped>
.event-card {
    width: 13em;
    margin: 1em auto 1em auto;
    padding: 1em;
    border: solid 1px #2c3e50;
    cursor: pointer;
    transition: all 0.2s linear;
}
.event-card:hover {
    transform: scale(1.01);
    box-shadow: 0 3px 12px 0 rgba(0, 0, 0, 0.2),
        0 1px 15px 0 rgba(0, 0, 0, 0.19);
}
.event-card h4 {
    font-size: 1.4em;
    margin-top: 0.5em;
    margin-bottom: 0.3em;
}
</style>
