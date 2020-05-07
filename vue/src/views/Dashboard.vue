<template>
    <div class="dashboard">
        <div class="nav">
            <div>
                <p>My profile</p>
            </div>
            <div>
                <p>Lobby</p>
            </div>
            <div>
                <p>Settings</p>
            </div>
        </div>
        <div class="main">
            <div>empty/logo?</div>
            <div>Dashboard navbar</div>
            <div>
                <p>forum posts</p>
                <template v-if="!isLoading">
                    <PostCard
                        v-for="userpost in userposts"
                        v-bind:key="userpost.id"
                        :post="userpost"
                    />
                </template>
                <p v-else>Loading posts</p>
            </div>
        </div>
        <div class="friendlist">
            <div>empty/logo?</div>
            <div>Search bar</div>
            <div>Friends<template  >
                 <Friendlist
                       v-for="friend in friends"
                        v-bind:key="friend.id"
                        :friend="friend"
                    />
                    </template>
            </div>
        </div>
    </div>
</template>

<script>
import PostCard from "@/components/PostCard";
import Friendlist from "@/components/Friendlist";

import { getAllFriends } from "@/services/friend.api";

import { mapActions, mapGetters } from "vuex";

export default {
    components: { PostCard, Friendlist },
    data() {
        return {
            isLoading: true,
            userposts: [],
            friends: []
        };
    },
    computed: {
        ...mapGetters("Forum", ["getUserPosts"])
    },
    methods: {
        ...mapActions("Forum", ["fetchUserPosts"])
    },
    async mounted() {
        // Make network request if the data is empty
        if (this.getUserPosts.length === 0) {
            // set loading screen
            this.isLoading = true;
            // await this.fetchPosts();

            await this.fetchUserPosts();

            this.userposts = this.getUserPosts;
            // console.log(this.posts[0].id)

            this.isLoading = false;
        } else {
            this.userposts = this.getUserPosts;
            this.isLoading = false;
        };

        try {
            const response = await getAllFriends();
            this.friends = response.data;
            console.log(response.data);
        } catch (error) {
            console.log(error);
        }
    },
};
</script>

<style lang="scss">
@import "@/assets/styles/styles.scss";

img {
    width: 150px;
    height: 150px;
}

.dashboard {
    display: flex;
}

.nav {
    flex: 0.5 1 auto;
    flex-direction: column;
}

.main {
    flex: 4 1 auto;
    flex-direction: column;
}

.friendlist {
    flex: 1.5 1 auto;
    flex-direction: column;
}
</style>