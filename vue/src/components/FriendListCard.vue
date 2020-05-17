<template>
  <div class="friendlistCard">
    <router-link :to="{ name: 'profile', params: { id: friend.id } }">
        <img src="https://placekitten.com/250/250" />
        <p>{{ friend.username }}</p>
        <p>{{ friend.email }}</p>
        <p>{{ friend.status.name }}</p>
    </router-link>
  </div>
</template>

<script>
export default {
  props: {
    friend: {
      type: Object,
      default: () => {
        return {};
      },
    },
  },
};
</script>

<style scoped></style>
