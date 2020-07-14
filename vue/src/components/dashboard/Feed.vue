<template>
  <div class="feed">
    <div class="feedNews">Feed component {{ data }}</div>
    <div class="feedHistory">
      <ul v-if="this.getHistoryNotifications.length">
        <li v-for="(historyNotification, index) in this.getHistoryNotifications" :key="index"><span>{{historyNotification.time}}</span>{{historyNotification.message}}</li>

      </ul>
      <div v-else class="feedNotificationsEmpty">
        No history available
      </div>
    </div>
  </div>
</template>

<script>

import { mapGetters } from "vuex";

export default {
  name: "Feed",
  props: {
    data: {
      type: Object,
      default: () => {
        return {};
      },
    },
  },
  computed: {
    ...mapGetters(["getHistoryNotifications"])
  }
};
</script>

<style></style>
