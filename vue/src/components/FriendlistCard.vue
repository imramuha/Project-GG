<template>
  <div class="friendlistCard">
    <a @click="onProfileClick" v-on:click="emitToFriendlist">
      <div v-if="friend.image" class="friendlistCardImg">
        <img :src="friend.image" />
      </div>
      <div v-else class="friendlistCardImg">
        <img src="@/assets/images/profile.jpeg" />
      </div>
      <div class="friendlistCardUser">
        <h1 class="friendlistCardUserName">{{ friend.username }}</h1>
        <p>{{ friend.email }}</p>
      </div>
      <div v-if="friend.status.name == 'online'" class="friendlistCardStatus">
        <!--<p>{{ friend.status.name }}</p>-->
        <div class="statusCircle"></div>
      </div>
      <div v-else class="friendlistCardStatus">
        <!--<p>{{ friend.status.name }}</p>-->
        <div class="statusCircleOffline"></div>
      </div>
    </a>
  </div>
</template>

<script>
export default {
  props: {
    friend: {
      type: Object,
      default: () => {
        return {};
      }
    }
  },
  data() {
    return {
      childMessage: null
    };
  },
  methods: {
    onProfileClick() {
      this.childMessage = {
        component: "Profile",
        id: this.friend.id
      };
      this.emitToFriendlist(this.childMessage);
    },
    emitToFriendlist(value) {
      this.$emit("emitToFriendlist", value);
    }
  }
};
</script>

<style scoped></style>
