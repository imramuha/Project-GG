<template>
  <div class="lounge">
    <h1>Lounge</h1>
    <button @click="exitLounge">Exit lounge</button>
    <h1>
      LoungeName: {{ loungeData.code }}, loungeCode: {{ loungeData.code }}
    </h1>
    <ul v-for="loungeUser in loungeUsers" v-bind:key="loungeUser.id">
      <li>{{ loungeUser.username }}</li>
    </ul>
  </div>
</template>

<script>
import { getLoungeData, exitLounge } from "@/services/queue.api";

export default {
  data() {
    return {
      lounge: "",
      loungeData: "",
      loungeUsers: []
    };
  },
  props: {
    lobby: {
      type: Object,
      default: () => {
        return {};
      }
    }
  },
  methods: {
    async exitLounge() {
      try {
        await exitLounge().then(response => {
          console.log(response);
        });
      } catch (error) {
        console.log(error);
      }
    }
  },
  async mounted() {
    this.lounge = this.lobby;
    try {
      console.log(this.lounge);
      await getLoungeData(this.lounge.id).then(response => {
        this.loungeData = response.data[0];
        this.loungeUsers = response.data[0].users;
        console.log(response.data);
      });
    } catch (error) {
      console.log(error);
    }
  }
};
</script>

<style></style>
