<template>
  <div class="friendlistCard">
    <a  @click="onProfileClick" v-on:click="emitToFriendlist">
      <div class="friendlistCardImg">
        <img src="https://placekitten.com/250/250" />
      </div>
      <div class="friendlistCardUser">
        <p>{{ friend.username }}</p>
        <p>{{ friend.email }}</p>
      </div>
      <div class="friendlistCardStatus"> 
        <p>{{ friend.status.name }}</p>
        <div class="statusCircle"></div>
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
          childMessage: null,
      };
  },
  methods: {
        onProfileClick() {
            this.childMessage = {
                component: "Profile",
                id: this.friend.id
            }
                 
            this.emitToFriendlist(this.childMessage);
        },
        emitToFriendlist(value) {
            this.$emit("emitToFriendlist", value);
        }
  }
};
</script>

<style scoped></style>
