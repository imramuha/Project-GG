<template>
  <div>
    <p>This is the WAITING ROOM/dashboard/home</p>
    <ul>
      <li>friendlist</li>
      <li>minifeed</li>
    </ul>
    <FriendList v-bind:friends="friends" />
  </div>
</template>

<script>
import FriendList from "@/views/FriendList.vue";

export default {
  components: {
    // child component
    FriendList
  },
  data() {
    return {
      friends: []
    };
  },
  created() {}
};
</script>
z