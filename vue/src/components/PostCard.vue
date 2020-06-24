<template>
    <div class="postCard">
     
            <div   @click="onPostCardClick"
            v-on:click="emitToPosts"  class="postcardImg">
              <div v-if="post.image">
                        <img :src="post.image" />
                </div>
                <div v-else>
                    <img src="@/assets/images/post.png" />
                </div>
            </div>
            <div class="postcardContent">
                   <a
            @click="onPostCardClick"
            v-on:click="emitToPosts"
        >
                <div class="postcardContentHeader">
                    <h1>{{ post.title }}</h1>
                </div>
                <div class="postcardContentBody">
                    <p>{{ post.date }}02/05/2002 - {{ post.liked_posts.length }}</p>
                    <p>
                        This is the post content, that will be added later on during this
                        project
                    </p>
                </div>
                   </a>
                <div class="postcardContentFooter">
                    <p>Comments (2)</p>
                    <p>Report</p>
                </div>
            </div>
            <div v-if='post.user_liked != true' class="postcardStats">
                <button type="button" @click="gg">GG</button>
                <p>{{ post.liked_posts.length }}</p>
           </div>
            <div v-else class="postcardStats">
                <p>{{ post.liked_posts.length }}</p>
                <button class="likeButtonActive" type="button" @click="gg">uGG</button>
            </div>
    </div>
</template>
<script>

import { likePost } from "@/services/forum.api";

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
            childMessage: "",
            //toggleLike: "liked",
        };
    },
    methods: {
        async gg() {
            /*console.log("you just GG'd this post :)");

            if (this.toggleLike == "liked") {
                this.toggleLike = "";
            } else {
                this.toggleLike = "liked";
            }*/

            let data = {
              post_id: this.post.id,        
            }
            try {
            await likePost(data).then(()=> {
                
                 // emit to parent
                this.childMessage = {
                    component: "remount"
                }

                console.log(this.childMessage);

                this.emitToPosts();


            });
            
            } catch (error) {
                console.log(error);
            }

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
