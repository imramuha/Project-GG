<template>
  <div class="notificationCard">
    <div class="notificationContent">
      <i class="fa fa-check-circle" aria-hidden="true"></i>
      <p>{{ notification.message }}</p>
      <a @click="remove(index)"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
    </div>
    <div class="slider" :style="styleObject"></div>
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
   data() {
    return {
      widthSlider: "100%",
      styleObject: {
        width: '100%',
        transition: 'width 10s ease',
      },
    }    
  },
  methods: {
    ...mapActions(["removeNotification"]),
    
    remove(index){
      this.removeNotification(index);
    },
    width() {
       this.styleObject.width = '0%';
    }
  }, 
  mounted() {
    try {
      setTimeout(() => this.width(), 50);
      setTimeout(() => this.removeNotification(this.index), 10000);
      
      //setTimeout(() => this.removeNotification(this.index), 10000);
    } catch (error) {
      console.log(error);
    }
  }
  // mount timeout to remove notif afteer few seconds on itso own
};
</script>
<style scoped></style>
