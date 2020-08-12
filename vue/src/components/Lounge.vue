<template>
  <div v-if="this.active" class="lounge">
    <div class="loungeHeader"><p>LOUNGE</p></div>
    <div class="loungeBody">
      <div class="loungeBodyUsers">
        <h3>
          Lounge <span>[{{ this.loungeData.name }}-{{ this.loungeData.code }}]</span>
        </h3>
        <div
          v-for="(loungeUser, index) in this.loungeUsers"
          :key="index"
          class="loungeBodyUsersCard">
          <div v-if="loungeUser.image" class="imgContainer">
            <img :src="loungeUser.image" />
          </div>
          <div v-else class="imgContainer">
            <img src="@/assets/images/profile.jpeg" />
          </div>

          <div class="loungeBodyUsersCardContent">
            <h1>
              {{ loungeUser.username }}
              <!--<span>game username</span>-->
            </h1>
            <!--<p>Here comes the game info</p>-->
          </div>
        </div>
        <div class="loungeBodyUsersCard">

        </div>
           <div class="loungeBodyUsersCard">
          
        </div>
           <div class="loungeBodyUsersCard">
          
        </div>

      </div>

      <div class="loungeBodyChat">
        <div class="loungeMessagesFeed" ref="feed">
          <ul v-if="this.loungeGroupmessages">
            <li
              class="loungeMessageReceived"
              v-for="groupmessage in this.loungeGroupmessages"
              :key="groupmessage.id"
            >
              <div class="loungeMessageIcon">
                <div v-if="groupmessage.user.image">
                  <img :src="groupmessage.user.image" />
                </div>
                <div v-else>
                  <img src="@/assets/images/profile.jpeg" />
                </div>
                <h1>{{ groupmessage.user.username }}</h1>
              </div>
              <div class="loungeMessageText">
                <p>{{ groupmessage.text }}</p>
                <span>{{ groupmessage.created_at | formatDateTime }}</span>
                <span></span>
              </div>
            </li>
          </ul>
        </div>
        <div class="loungeMessageComposer">
          <textarea
            v-model="text"
            @keydown.enter="sendGroupMessage"
            placeholder="Message ..."
          ></textarea>
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
import {
  getLoungeData,
  exitLounge,
  postGroupMessage,
} from "@/services/queue.api";

export default {
  data() {
    return {
      active: true,
      lounge: "",
      loungeData: "",
      loungeUsers: [],
      loungeGroupmessages: [],
      text: "",
    };
  },
  props: {
    lobby: {
      type: Object,
      default: () => {
        return {};
      },
    },
  },
  methods: {
    async exitLounge() {
      try {
        await exitLounge().then((response) => {
          console.log(response);
        });
      } catch (error) {
        console.log(error);
      }
    },
    handleIncoming(data) {
      console.log(data);
      if (!data) {
        this.active = false;
      } else {
        this.active = true;
      }

      this.loungeData = data;

      if (this.loungeData) {
        this.loungeUsers = this.loungeData.users;
        this.loungeGroupmessages = this.loungeData.group_messages;
      }
    },
    async sendGroupMessage(e) {
      e.preventDefault();

      if (this.text == "") {
        return;
      }

      let groupMessage = {
        text: this.text,
      };
      try {
        await postGroupMessage(groupMessage).then((response) => {
          console.log(response);
          this.text = "";
        });
      } catch (error) {
        console.log(error);
      }
    },
    saveNewMessage(text) {
      this.loungeGroupmessages.push(text);
    },
    scrollToBottom() {
      // subtract the scroll height from the client
      setTimeout(() => {
        this.$refs.feed.scrollTop =
          this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
      }, 50);
    },
  },
  async mounted() {
    /* global pusher */

    this.lounge = this.lobby;
    try {
      await getLoungeData(this.lounge.id).then((response) => {
        console.log(response);
        this.loungeData = response.data;
        this.loungeUsers = response.data.users;
        this.loungeGroupmessages = response.data.group_messages;

        const channel = pusher.subscribe(
          `private-lounge${this.loungeData.code}`
        );

        channel.bind("NewLounge", (data) => {
          this.handleIncoming(data);
        });
      });
    } catch (error) {
      console.log(error);
    }
  },
  watch: {
    loungeData: function(loungeData) {
      this.scrollToBottom();
      console.log(loungeData);
    },
  },
};
</script>

<style></style>
