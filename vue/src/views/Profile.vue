<template>
  <div>
    <p>This is user X's profile {{ id }}{{ friend.id }}{{ friend.username }}</p>
    <button>hi</button>
    <p>{{ relation.name }}</p>
    <ul>
      <li>User X</li>
      <li>User X facepic :)</li>
    </ul>
  </div>
</template>

<script>
export default {
  props: ["id"],
  data() {
    return {
      friend: [],
      relation: []
    };
  },
  created() {}
};
</script>

<style></style>
