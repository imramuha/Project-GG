<template>
  <div class="inbox">
    <Conversation :friend="selectedFriend" :messages="messages" />
    <MessagersList :friends="friends" @selected="startConversationWith" />
  </div>
</template>

<script>
import Conversation from "@/components/Conversation";
import MessagersList from "@/components/MessagersList";

import { getAllFriends } from "@/services/friend.api";
import { getConversation } from "@/services/inbox.api";

export default {
  components: { Conversation, MessagersList },
  data() {
    return {
      selectedFriend: null,
      messages: [],
      friends: [],
    };
  },
  async mounted() {
    try {
      const response = await getAllFriends();
      this.friends = response.data;
      console.log(response.data);
    } catch (error) {
      console.log(error);
    }
  },
  methods: {
    async startConversationWith(friend) {
      console.log(friend);
      try {
        const response = await getConversation(friend.id);
        this.messages = response.data;
        this.selectedFriend = friend;
        console.log(response.data);
      } catch (error) {
        console.log(error);
      }
    },
  },
};
</script>

<style></style>
