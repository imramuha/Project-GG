<template>
  <div class="dashboard">
    <div class="sidenavContainer">
      <div class="sidenav">
        <div class="sidenavLogo">
          <router-link to="/"
            ><img src="@/assets/images/logo.svg"
          /></router-link>
        </div>
        <!--<router-link to="/user" class="button">Lobby</router-link>-->
        <button
          type="button"
          class="queueButton"
          @click="queue"
          title="Queue up"
        >
          <i class="fa fa-gamepad" aria-hidden="true"></i>
        </button>
        <div class="sidenavButtons">
          <router-link to="/">
            <i class="fas fa-home"></i>
          </router-link>
          <a @click="onDashboardNavClick('feed')" class="button">
            <i class="fas fa-tachometer-alt"></i>
          </a>
          <a @click="onOverscreenClick(forum)" class="button">
            <i class="far fa-comment-alt"></i>
          </a>
          <a
            type="button"
            class="button"
            @click="settings"
            title="Settings and preferences"
          >
            <i class="fas fa-cog"></i>
          </a>
          <a type="button" @click="logout">
            <i class="fas fa-sign-out-alt"></i>
          </a>
        </div>
      </div>
    </div>
    <div v-if="contentActive" class="content">
      <ProfileHeader v-on:emitToOverscreen="onOverscreenClick" />
      <div class="contentNav">
        <template>
          <DashboardNav v-on:emitToDashboard="onDashboardNavClick" />
        </template>
      </div>
      <div class="contentMain">
        <!-- TBD loading/api call loader <template v-if="!isLoading">-->
        <template>
          <component
            v-on:emitToOverscreen="onOverscreenClick"
            :is="mainComponent"
          ></component>
        </template>
        <!--<p v-else>Loading posts</p>-->
      </div>
    </div>
    <div v-else class="overscreenContainer">
      <div class="overscreen">
        <div class="overscreenContent">
          <template>
            <component
              :data="overscreenData"
              :key="overscreenData"
              :is="overscreenComponent"
              v-on:emitToOverscreen="onOverscreenClick"
              v-on:emitToDashboard="onDashboardNavClick"
            ></component>
          </template>
        </div>
      </div>
    </div>
    <div class="sidecontent">
      <div class="sidecontentHeader">
        <div class="sidecontentNotifications">
          <div v-if="this.getNotifications.length">
            <NotificationCard
              v-for="(notification, index) in this.getNotifications"
              v-bind:key="index"
              :index="index"
              :notification="notification"
            />
          </div>
          <div v-else class="notificationsEmpty">
            There are no notifications available.
          </div>
        </div>
      </div>
      <div class="sidecontentFunction">
        <SearchInput v-on:emitToOverscreen="onOverscreenClick" />
      </div>
      <div class="sidecontentFriendlist">
        <template>
          <Friendlist v-on:emitToOverscreen="onOverscreenClick" />
        </template>
      </div>
    </div>
  </div>
</template>

<script>
// import httpClient from "@/services/httpClient";
import Friendlist from "@/components/dashboard/Friendlist";
import DashboardNav from "@/components/dashboard/DashboardNav";
import ProfileHeader from "@/components/dashboard/ProfileHeader";

import Reviews from "@/components/dashboard/Reviews";
import Inbox from "@/components/dashboard/Inbox";
import Feed from "@/components/dashboard/Feed";
import Games from "@/components/dashboard/Games";
import Posts from "@/components/dashboard/Posts";
import News from "@/components/dashboard/News";

import SearchInput from "@/components/SearchInput";
import UserSearch from "@/components/UserSearch";
import NotificationCard from "@/components/NotificationCard";

import Post from "@/views/Post";
import UserEdit from "@/views/UserEdit";
import PostCreate from "@/views/PostCreate";
import Profile from "@/views/Profile";
import Forum from "@/views/Forum";
import UserGameAdd from "@/views/UserGameAdd";

import Queue from "@/components/Queue";
import Settings from "@/components/Settings";

import { mapGetters } from "vuex";

export default {
  components: {
    Posts,
    Post,
    Games,
    Feed,
    News,
    Inbox,
    Queue,
    Reviews,
    Friendlist,
    DashboardNav,
    ProfileHeader,
    SearchInput,
    NotificationCard,
    UserSearch,
    UserGameAdd,
    Profile,
    Forum
  },
  computed: {
    ...mapGetters(["getNotifications"])
  },
  data() {
    return {
      // isLoading: true,
      items: [],
      mainComponent: Feed,
      emit: "feed",
      contentActive: true,
      overscreenComponent: null,
      overscreenData: null,
      forum: "forum"
      //notification: true,
    };
  },
  methods: {
    // Triggered when `childtodashboard` event is emitted by the child. <---- needs cleaning
    onDashboardNavClick(value) {
      console.log(value);
      this.emit = value;
      if (value == "feed") {
        this.contentActive = true;
        this.mainComponent = Feed;
      } else if (value == "inbox") {
        this.mainComponent = Inbox;
      } else if (value == "news") {
        this.mainComponent = News;
      } else if (value == "games") {
        this.contentActive = true;
        this.mainComponent = Games;
      } else if (value == "reviews") {
        this.mainComponent = Reviews;
      } else if (value == "posts") {
        this.contentActive = true;
        this.mainComponent = Posts;
      }
    },
    queue() {
      this.mainComponent = Queue;
    },
    settings() {
      this.mainComponent = Settings;
    },
    logout() {
      this.$store.dispatch("logout").then(() => {
        this.$router.push("/");
      });
    },
    onOverscreenClick(value) {
      console.log(value.component);
      // clear the overscreen if someone else is pressed..
      if (
        value.component === "PostCard" ||
        value.component === "ForumPostCard"
      ) {
        this.contentActive = false;
        this.overscreenComponent = Post;
        this.overscreenData = value.id;
      }
      if (value.component === "UserEdit") {
        this.contentActive = false;
        this.overscreenComponent = UserEdit;
      }
      if (value.component === "PostCreate") {
        this.contentActive = false;
        this.overscreenComponent = PostCreate;
      }
      if (value.component === "Profile") {
        this.contentActive = false;
        this.overscreenComponent = Profile;
        this.overscreenData = value.id;
      }
      if (value.component === "UserSearch") {
        this.contentActive = false;
        this.overscreenComponent = UserSearch;
        this.overscreenData = value.searchTerm;
      }
      if (value.component === "UserGameAdd") {
        this.contentActive = false;
        this.overscreenComponent = UserGameAdd;
      }
      if (value === "forum") {
        this.contentActive = false;
        this.overscreenComponent = Forum;
      }
    }
  }
};
</script>

<style lang="scss"></style>
