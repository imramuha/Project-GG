<template>
  <div class="friendlist">
    <div class="friendlistCategory">
      <h1 v-on:click="toggleOnline">
        online ({{ onlineFriends.length }}) <span>{{ toggleIconOnline }}</span>
      </h1>

      <FriendlistCard
        v-show="showOnlineSection"
        v-for="friend in onlineFriends"
        v-bind:key="friend.id"
        :friend="friend"
      />
    </div>
    <div class="friendlistCategory">
      <h1 v-on:click="toggleOffline">
        offline ({{ offlineFriends.length }})
        <span>{{ toggleIconOffline }}</span>
      </h1>
      <FriendlistCard
        v-show="showOfflineSection"
        v-for="friend in offlineFriends"
        v-bind:key="friend.id"
        :friend="friend"
      />
    </div>
  </div>
</template>

<script>
import { getAllFriends } from "@/services/friend.api";

import FriendlistCard from "@/components/FriendlistCard";

export default {
  name: "Friendlist",
  components: { FriendlistCard },
  data() {
    return {
      friends: [],
      offlineFriends: [],
      onlineFriends: [],
      showOnlineSection: true,
      showOfflineSection: false,
      toggleIconOnline: "-",
      toggleIconOffline: "+"
    };
  },
  methods: {
    toggleOnline() {
      this.showOnlineSection = !this.showOnlineSection;
      if (this.toggleIconOnline == "+") {
        this.toggleIconOnline = "-";
      } else {
        this.toggleIconOnline = "+";
      }
    },
    toggleOffline() {
      this.showOfflineSection = !this.showOfflineSection;
      if (this.toggleIconOffline == "+") {
        this.toggleIconOffline = "-";
      } else {
        this.toggleIconOffline = "+";
      }
    }
  },
  async mounted() {
    try {
      const response = await getAllFriends();
      this.friends = response.data;

      // adds friends to either online of offline array :)
      this.friends.forEach(item => {
        if (item.status.name == "online") {
          this.onlineFriends.push(item);
        }
        if (item.status.name == "offline") {
          this.offlineFriends.push(item);
        }
      });
      console.log(this.offlineFriends);
      console.log(this.onlineFriends);
    } catch (error) {
      console.log(error);
    }
  }
};
</script>

<style scoped>
.friendlist img {
  width: 50px;
  height: 50px;
}
</style>
