<template>
    <div class="dashboard">
        <div class="sidenav">
            <div class="sidenavLogo">
              <img src="@/assets/images/logo.svg" />
            </div>
            <!--<router-link to="/user" class="button">Lobby</router-link>-->
            <button type="button" class="logoutButton" @click="queue">
                Queue up
            </button>
            <div class="sidenavButtons">
                <router-link to="/"><i class="fas fa-home"></i></router-link>
                <router-link to="/dashboard"><i class="fas fa-tachometer-alt"></i></router-link>
                <router-link to="/forum" class="button"><i class="far fa-comment-alt"></i></router-link>
                <router-link to="/user" class="button"><i class="fas fa-cog"></i></router-link>
                <button type="button" class="logoutButton" @click="logout">Logout</button>
            </div>
        </div>
        <div v-if="contentActive" class="content">
            <ProfileHeader />
            <div class="contentNav">
                <template>
                    <DashboardNav v-on:emitToDashboard="onDashboardNavClick" />
                </template>
            </div>
            <div class="contentMain">
                <!-- TBD loading/api call loader <template v-if="!isLoading">-->
                <template>
                    <component :is="mainComponent"></component>
                </template>
                <!--<p v-else>Loading posts</p>-->
            </div>
        </div>
        <div v-else class="overscreen">
            <h1>Overscreen</h1>
        </div>
        <div class="sidecontent">
            <div class="sidecontentHeader">
                <div class="sidecontentNotifications">
                    <div class="notificationsEmpty">There are no notifications available.  emitting: {{ emit }}</div>
                </div>
            </div>
            <div class="sidecontentFunction">
                <form>
                    <input type="text" placeholder="Search a player.." name="search" />
                    <button type="button" @click="search">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
            <div class="sidecontentFriendlist">
                <template>
                    <Friendlist />
                </template>
            </div>
        </div>
    </div>
</template>

<script>
import Friendlist from "@/components/dashboard/Friendlist";
import DashboardNav from "@/components/dashboard/DashboardNav";
import ProfileHeader from "@/components/dashboard/ProfileHeader";

import Reviews from "@/components/dashboard/Reviews";
import Inbox from "@/components/dashboard/Inbox";
import Feed from "@/components/dashboard/Feed";
import Games from "@/components/dashboard/Games";
import Posts from "@/components/dashboard/Posts";
import News from "@/components/dashboard/News";

import Queue from "@/components/Queue";

export default {
    components: { Posts, Games, Feed, News, Inbox, Queue, Reviews, Friendlist, DashboardNav, ProfileHeader },
    data() {
        return {
            // isLoading: true,
            items: [],
            mainComponent: Feed,
            emit: "feed",
            contentActive: true,
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
            } else if (value == "news") {
                this.mainComponent = News;
            } else if (value == "games") {
                this.mainComponent = Games;
            } else if (value == "reviews") {
                this.mainComponent = Reviews;
            } else if (value == "posts") {
                this.mainComponent = Posts;
            }
        },
        queue() {
            this.mainComponent = Queue
        },
        logout() {
            this.$store.dispatch("logout");
        },
        search() {
           
            if(this.contentActive == true) {
                this.contentActive = false;
            } else {
                this.contentActive = true;
            }
        }
    }
};
</script>

<style lang="scss"></style>
