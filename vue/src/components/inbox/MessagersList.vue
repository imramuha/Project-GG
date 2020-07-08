<template>
  <div class="messagersList">
    <h1>Friends</h1>
    <ul>
      <li
        v-for="(friend, index) in friends"
        :key="friend.id"
        @click="selectedFriend(index, friend)"
        :class="{ selected: index == selected }"
      >
        <div v-if="friend.image">
          <img :src="friend.image" />
        </div>
        <div v-else>
          <img src="@/assets/images/profile.jpeg" />
        </div>
        <p>{{ friend.username }}</p>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    friends: {
      type: Array,
      defaults: []
    }
  },
  data() {
    return {
      selected: 0
    };
  },
  methods: {
    selectedFriend(index, friend) {
      this.selected = index;
      this.$emit("selected", friend);
    }
  }
};
</script>
