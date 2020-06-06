<template>
  <div>
    <div v-if="friend.image">
      <img :src="friend.image" />
    </div>
    <div v-else> 
            <img src="@/assets/images/profile.jpeg" />
    </div>
    <ul>
      <li>{{ friend.id }}</li>
      <li>{{ friend.username }}</li>
      <li>{{ friend.email }}</li>
      <li>{{ this.relation.name }}</li>
    </ul>
    <button v-if="this.activeButton == ''" href="#" variant="primary">Friend</button>
    <button v-if="this.activeButton == 'pending_first_second'" href="#" variant="primary">Sent request</button>
        <button v-if="this.activeButton == 'pending_first_second'" href="#" variant="primary">Cancel request</button>
    <button v-if="this.activeButton == 'pending_second_first'" href="#" variant="primary">Accept request</button>
    <button v-if="this.activeButton == 'pending_second_first'" href="#" variant="primary">Deny request</button>
    <button v-if="this.activeButton == 'friends'" href="#" variant="primary">Unfriend</button>
    <button v-if="this.activeButton == ''" href="#" variant="primary">Block</button>
    <button v-if="this.activeButton == 'block_first_second' || !this.activeButton == 'block_both'" href="#" variant="primary">Unblock</button>
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
      relation: [],
      activeButton: '',
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

      this.activeButton = this.relation.name

      console.log(this.activeButton);


      //console.log(this.friend.id);
    } catch (error) {
      console.log(error);
    }
  }
};
</script>

<style></style>
