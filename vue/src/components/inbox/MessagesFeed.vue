<template>
  <div class="messagesFeed" ref="feed">
    <ul v-if="friend">
      <li
        v-for="message in messages"
        :class="`message${message.to == friend.id ? 'sent' : 'received'}`"
        :key="message.id"
      >
        <div class="messageIcon" v-if="friend.image">
          <img :src="friend.image" />
        </div>
        <div class="messageIcon" v-else>
          <img src="@/assets/images/profile.jpeg" />
        </div>
        <div class="messageText">
          <p>{{ message.text }}</p>
          <span>{{ message.created_at | formatDateTime }}</span>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    friend: {
      type: Object
    },
    messages: {
      type: Array,
      required: true
    }
  },
  methods: {
    scrollToBottom() {
      // subtract the scroll height from the client
      setTimeout(() => {
        this.$refs.feed.scrollTop =
          this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
      }, 50);
    }
  },
  watch: {
    friend: function(friend) {
      this.scrollToBottom();
      console.log(friend);
    },
    messages: function(messages) {
      this.scrollToBottom();
      console.log(messages);
    }
  }
};
</script>
