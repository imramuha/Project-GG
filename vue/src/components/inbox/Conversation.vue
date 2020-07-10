<template>
  <div v-if="friend" class="conversation">
    <div class="conversationHeader">
      <div v-if="friend.image">
        <img :src="friend.image" />
      </div>
      <div v-else>
        <img src="@/assets/images/profile.jpeg" />
      </div>
      <h1
        v-if="friend.status.name === 'offline'"
        class="conversationUserOffline"
      >
        {{ friend.username }}<span>{{ friend.status.name }}</span>
      </h1>
      <h1
        v-else-if="friend.status.name === 'online'"
        class="conversationUserOnline"
      >
        {{ friend.username }}<span>{{ friend.status.name }}</span>
      </h1>
      <h1 v-else>
        {{ friend.username }}<span>{{ friend.status.name }}</span>
      </h1>
    </div>
    <MessagesFeed :friend="friend" :messages="messages" />
    <MessageComposer @send="sendMessage" />
  </div>
  <div class="conversation" v-else>
    <p class="conversationEmpty">Please select a friend from the friendlist to chat with</p>
  </div>
</template>

<script>
import MessagesFeed from "@/components/inbox/MessagesFeed";
import MessageComposer from "@/components/inbox/MessageComposer";

import { postMessage } from "@/services/inbox.api";

export default {
  components: { MessagesFeed, MessageComposer },
  props: {
    friend: {
      type: Object,
      default: null
    },
    messages: {
      type: Array
      //default: [],
    }
  },
  methods: {
    async sendMessage(text) {
      if (!this.friend) {
        return;
      }

      let userMessage = {
        text: text,
        friend_id: this.friend.id
      };

      console.log(userMessage);
      try {
        await postMessage(userMessage).then(response => {
          this.$emit("new", response.data);
        });
      } catch (error) {
        console.log(error);
      }
    }
  }
};
</script>
