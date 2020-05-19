<template>
  <div class="friendlistCard">
    <router-link :to="{ name: 'profile', params: { id: friend.id } }">
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
      }
    }
  }
};
</script>

<style scoped></style>
