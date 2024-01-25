<template>
  <div class="inbox">
    <Conversation
      :friend="selectedFriend"
      :messages="messages"
      @new="saveNewMessage"
    />
    <div v-if="loading" class="ldsContainer">
      <div class="ldsRipple">
        <div></div>
        <div></div>
      </div>
    </div>
    <MessagersList
      v-else
      :friends="friends"
      @selected="startConversationWith"
    />
  </div>
</template>

<script>
import Conversation from "@/components/inbox/Conversation";
import MessagersList from "@/components/inbox/MessagersList";

import { getAllFriends } from "@/services/friend.api";
import { getConversation } from "@/services/inbox.api";

import { getMe } from "@/services/user.api";

export default {
  components: { Conversation, MessagersList },
  data() {
    return {
      selectedFriend: null,
      messages: [],
      friends: [],
      // change this
      user: [],
      loading: true
    };
  },
  mounted() {
    try {
      getMe().then(response => {
        this.user = response;

        /* global pusher */
        const channel = pusher.subscribe(
          `private-messages${this.user.data.user[0].id}`
        );

        channel.bind("NewMessage", data => {
          console.log(data);
          this.handleIncoming(data);
        });
      });

      getAllFriends().then(response => {
        this.friends = response.data;
        this.loading = false;
      });
    } catch (error) {
      console.log(error);
    }
  },
  methods: {
    async startConversationWith(friend) {
      //console.log(friend);
      try {
        const response = await getConversation(friend.id);
        this.messages = response.data;
        this.selectedFriend = friend;
        //console.log(response.data);
      } catch (error) {
        console.log(error);
      }
    },
    saveNewMessage(text) {
      this.messages.push(text);
    },
    handleIncoming(data) {
      if (this.selectedFriend && data.from == this.selectedFriend.id) {
        this.saveNewMessage(data);
        // messages?
        this.message.push(data);
      }
    }
  }
};
</script>

<style></style>
