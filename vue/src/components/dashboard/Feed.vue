<template>
  <div class="feed">
    <div v-if="loading" class="ldsContainer">
      <div class="ldsRipple">
        <div></div>
        <div></div>
      </div>
    </div>

    <div v-else-if="!loading" class="feedNews">
      <div class="feedNewsHeader">
        <h1>News</h1>
        <button
          :class="[active === 0 ? 'newsButtonActive' : 'newsButtonDeactive']"
          @click="slide(0)"
        />
        <button
          :class="[active === 1 ? 'newsButtonActive' : 'newsButtonDeactive']"
          @click="slide(1)"
        />
        <button
          :class="[active === 2 ? 'newsButtonActive' : 'newsButtonDeactive']"
          @click="slide(2)"
        />
      </div>
      <div
        :class="[active === index ? 'newsActive' : 'newsDeactive']"
        v-for="(newsItem, index) in news"
        :key="index"
      >
        <h2>
          {{ newsItem.title
          }}<span
            >[ created at <span>{{ newsItem.created_at | formatDate }}</span> by
            <span>{{ newsItem.user.username }}</span> ]</span
          >
        </h2>
        <p>{{ newsItem.text }}</p>
      </div>
    </div>

    <div class="feedHistory">
      <ul v-if="this.getHistoryNotifications.length">
        <li
          v-for="(historyNotification, index) in this.getHistoryNotifications"
          :key="index"
        >
          <span>{{ historyNotification.time }}</span
          >{{ historyNotification.message }}
        </li>
      </ul>
      <div v-else class="feedNotificationsEmpty">
        No history available
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import { getNews } from "@/services/forum.api";

export default {
  name: "Feed",
  props: {
    data: {
      type: Object,
      default: () => {
        return {};
      }
    }
  },
  data() {
    return {
      news: [],
      active: 0,
      loading: true
    };
  },
  computed: {
    ...mapGetters(["getHistoryNotifications"])
  },
  methods: {
    slide(value) {
      console.log(value);
      this.active = value;
    }
  },
  async mounted() {
    try {
      const response = await getNews();
      this.news = response.data;
      this.loading = false;
    } catch (error) {
      console.log(error);
    }
  }
};
</script>

<style></style>
