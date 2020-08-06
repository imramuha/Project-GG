<template>
  <!--<div class="lounge">
    <h1>Lounge</h1>
    <button @click="exitLounge">Exit lounge</button>
    <h1>
      LoungeName: {{ loungeData.code }}, loungeCode: {{ loungeData.code }}
    </h1>
    <ul v-for="loungeUser in loungeUsers" v-bind:key="loungeUser.id">
      <li>{{ loungeUser.username }}</li>
    </ul>
  </div>-->
  <div v-if="this.active" class="lounge">
    <div class="loungeHeader"><p>LOUNGE</p></div>
    <div class="loungeBody">
      <div class="loungeBodyUsers">
        <h3>
          Lounge:
          <span>{{ this.loungeData.name }} - {{ this.loungeData.code }}</span>
        </h3>
        <div class="loungeBodyUsersCard">
          <img src="@/assets/images/profile.jpeg" />
          <div
            v-for="(loungeUser, index) in this.loungeUsers"
            :key="index"
            class="loungeBodyUsersCardContent"
          >
            <h1>{{ loungeUser.username }}<span>game username</span></h1>
            <p>Here comes the game info</p>
          </div>
        </div>
      </div>

      <div class="loungeBodyChat" disabled>
        <div class="loungeMessagesFeed">
          <ul>
            <li class="loungeMessageReceived">
              <div class="loungeMessageIcon">
                <img
                  src="data:image/jpeg;base64,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"
                />
              </div>
              <div class="loungeMessageText">
                <p>This part isn't finished yet</p>
                <span>07/07/2020 - 09:16</span>
                <span></span>
              </div>
            </li>
            <li class="loungeMessageSent">
              <div class="loungeMessageIcon">
                <img
                  src="data:image/jpeg;base64,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"
                />
              </div>
              <div class="loungeMessageText">
                <p>Still WIP ^^</p>
                <span>07/07/2020 - 09:16</span>
              </div>
            </li>
          </ul>
        </div>
        <div class="loungeMessageComposer">
          <textarea placeholder="Message ..."></textarea>
        </div>
      </div>
    </div>
    <div class="loungeButtons">
      <button disabled>REVEAL</button>
      <button @click="exitLounge">LEAVE</button>
    </div>
  </div>
</template>

<script>
import { getLoungeData, exitLounge } from "@/services/queue.api";

export default {
  data() {
    return {
      active: true,
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
    },
    handleIncoming(data) {
      if (!data) {
        this.active = false;
      } else {
        this.active = true;
      }
      this.loungeData = data;
      this.loungeUsers = data.users;
    }
  },
  async mounted() {
    /* global pusher */

    this.lounge = this.lobby;
    try {
      console.log(this.lounge);
      await getLoungeData(this.lounge.id).then(response => {
        console.log(response.data);
        this.loungeData = response.data;
        console.log(this.loungeData);
        this.loungeUsers = response.data.users;
        console.log(this.loungeUsers);

        const channel = pusher.subscribe(
          `private-lounge${this.loungeData.code}`
        );

        channel.bind("NewLounge", data => {
          console.log(data);
          this.handleIncoming(data);
        });
      });
    } catch (error) {
      console.log(error);
    }
  }
};
</script>

<style></style>
