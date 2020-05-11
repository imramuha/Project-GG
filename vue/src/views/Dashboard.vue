<template>
    <div class="dashboard">
        <div class="nav">
            <div>
                <router-link to="/user" class="button">My profile</router-link>
            </div>
            <div>
                <p>Lobby</p>
            </div>
            <div>
                <p>Settings</p>
            </div>
        </div>
        <div class="main">
            <div>empty/logo? - emitting: {{ emit }}</div>
            <div>
                <DashboardNav v-on:emitToDashboard="onDashboardNavClick" />
            </div>
            <div>
                <!-- TBD loading/api call loader <template v-if="!isLoading">-->
                <template>
                    <component
                        :is="mainComponent"
                    ></component>
                </template>
                <!--<p v-else>Loading posts</p>-->
            </div>
        </div>
        <div class="friendlist">
            <div>empty/logo?</div>
            <div>Search bar</div>
            <div>
                Friends
                <template>
                    <Friendlist v-for="friend in friends" v-bind:key="friend.id" :friend="friend" />
                </template>
            </div>
        </div>
    </div>
</template>

<script>

import Friendlist from "@/components/dashboard/Friendlist";
import DashboardNav from "@/components/dashboard/DashboardNav";

import Reviews from "@/components/dashboard/Reviews";
import Inbox from "@/components/dashboard/Inbox";
import Feed from "@/components/dashboard/Feed";
import Posts from "@/components/dashboard/Posts";

import { getAllFriends } from "@/services/friend.api";


export default {
    components: { Posts, Feed, Inbox, Reviews, Friendlist, DashboardNav },
    data() {
        return {
            // isLoading: true,
            friends: [],
            items: [],
            mainComponent: Feed,
            emit: "feed"
        };
    },
    methods: {
        // Triggered when `childtodashboard` event is emitted by the child. <---- needs cleaning
        onDashboardNavClick(value) {
            this.emit = value;
            if (value == "feed") {
                this.mainComponent = Feed;
            } else if (value == "inbox") {
                this.mainComponent = Inbox;
            } else if (value == "reviews") {
                this.mainComponent = Reviews;
            } else if (value == "posts") {
                this.mainComponent = Posts;
            }
        }
    },
    async mounted() {
        try {
            const response = await getAllFriends();
            this.friends = response.data;
            console.log(response.data);
        } catch (error) {
            console.log(error);
        }
    }
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