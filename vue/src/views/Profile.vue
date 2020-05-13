<template>
  <div>
    <ul>
      <li>{{ friend.id }}</li>
      <li>{{ friend.username }}</li>
      <li>{{ friend.email }}</li>
      <li>{{ relation.name }}</li>
    </ul>
    <b-button href="#" variant="primary">Friend</b-button>
    <b-button href="#" variant="primary">Unfriend</b-button>
    <b-button href="#" variant="primary">Block</b-button>
    <b-button href="#" variant="primary">Unblock</b-button>
    <ReviewInput :id="friend.id" />
  </div>
</template>

<script>
import { getFriend } from "@/services/friend.api";

import ReviewInput from "@/components/ReviewInput";

export default {
  components: { ReviewInput },
  props: ["id"],
  data() {
    return {
      friend: [],
      relation: [],
    };
  },
  async mounted() {
        try {
            const response = await getFriend(this.id);
            this.friend = response.data.user[0];
            
            this.relation = response.data.relation[0];

            //console.log(this.friend.id);
        } catch (error) {
            console.log(error);
        }
    },
};
</script>

<style></style>
