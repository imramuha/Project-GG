<template>
  <div class="notificationCard">
    <i class="fa fa-check-circle" aria-hidden="true"></i>
    <p>{{ notification.message }}</p>
    <a @click="remove(index)"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
  </div>
</template>

<script>

import { mapActions } from "vuex";

export default {
  name: "NotificationCard",
  props: {
    notification: {
      type: Object,
      default: () => {
        return {};
      }
    },
    index: {
      type: Number,
    }
  },
  methods: {
    ...mapActions(["removeNotification"]),
    
    remove(index){
      this.removeNotification(index);
    }
  }
  // mount timeout to remove notif afteer few seconds on itso own
};
</script>
<style scoped></style>
