<template>
  <div>
    <div v-if="friend.image">
      <img :src="friend.image" />
    </div>
    <ul>
      <li>{{ friend.id }}</li>
      <li>{{ friend.username }}</li>
      <li>{{ friend.email }}</li>
      <li>{{ this.relation.name }}</li>
    </ul>
    <button href="#" variant="primary">Friend</button>
    <button href="#" variant="primary">Unfriend</button>
    <button href="#" variant="primary">Block</button>
    <button href="#" variant="primary">Unblock</button>
    <ReviewInput :id="friend.id" />
  </div>
</template>

<script>
import { getFriend, getRelation } from "@/services/friend.api";

import ReviewInput from "@/components/ReviewInput";

export default {
  components: { ReviewInput },
  props: ["id"],
  data() {
    return {
      friend: [],
      relation: []
    };
  },
  async mounted() {
    try {
      const response = await getFriend(this.id);
      this.friend = response.data.user[0];
      console.log(response.data)
      console.log(this.friend);

      //console.log(this.friend.id);
    } catch (error) {
      console.log(error);
    }
     try {
      const response = await getRelation(this.id);
      console.log(response);
      this.relation = response.data[0];
      console.log(this.relation)

      //console.log(this.friend.id);
    } catch (error) {
      console.log(error);
    }
  }
};
</script>

<style></style>
