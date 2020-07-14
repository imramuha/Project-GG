<template>
  <div class="queuelounge">
    <div v-if="!this.mainComponent == Lounge" class="queue">
      <div class="queueHeader"><p>QUEUE</p></div>
      <div class="queueBody">
        <div class="queueForm">
          <div class="queueGames">
            <label for="firstOption">Games</label>
            <select v-model="firstOption" :selected="0">
              <option disabled value>Select your game</option>
              <option
                v-for="(queuegame, index) in queuegames"
                v-bind:key="queuegame.id"
                :value="index"
                >{{ queuegame.name }}</option
              >
            </select>
          </div>

          <div class="queueOptions">
            <label for="firstOption">Options</label>
            <select
              v-model="secondOption"
              :selected="0"
              v-if="this.queuegames[firstOption]"
            >
              <option disabled value>Select your option</option>
              <option
                v-for="(option, index) in queuegames[firstOption].options"
                v-bind:key="option.id"
                :value="index"
                >{{ option.name }}</option
              >
            </select>
          </div>
        </div>
        <div class="queueErrors">
         <p v-if="errors.length">
            <b>Please correct the following error(s):</b>
            <ul>
              <li v-for="error in errors" v-bind:key="error" >- {{ error }}</li>
            </ul>
          </p>
        </div>
      </div>
      <div class="queueUp">
        <button type="button" class="logoutButton" @click="lounge">
          JOIN
        </button>
      </div>
    </div>

    <div v-if="this.mainComponent == Lounge" class="lounge">
      <div class="loungeHeader"><p>LOUNGE</p></div>
      <div class="loungeBody">
        <!--<template>
          <component
            :lobby="lobby"
            v-bind:key="lobby.id"
            :is="mainComponent"
          ></component>
        </template>-->
        <div class="loungeBodyUsers">
          <div class="loungeBodyUsersCard">
            <img src="@/assets/images/profile.jpeg" />
            <div class="loungeBodyUsersCardContent">
              <h1>Peeka<span>P13Ka</span></h1>
              <p>I am almost bronze lol, so close</p>
            </div>
          </div>
          <div class="loungeBodyUsersCard">
            <img src="@/assets/images/profile.jpeg" />
            <div class="loungeBodyUsersCardContent">
              <h1>Peeka<span>P13Ka</span></h1>
              <p>I am almost bronze lol, so close</p>
            </div>
          </div>
          <div class="loungeBodyUsersCard">
            <img src="@/assets/images/profile.jpeg" />
            <div class="loungeBodyUsersCardContent">
              <h1>Peeka<span>P13Ka</span></h1>
              <p>I am almost bronze lol, so close</p>
            </div>
          </div> 
          <div class="loungeBodyUsersCard">
            <img src="@/assets/images/profile.jpeg" />
            <div class="loungeBodyUsersCardContent">
              <h1>Peeka<span>P13Ka</span></h1>
              <p>I am almost bronze lol, so close</p>
            </div>
          </div>
          <div class="loungeBodyUsersCard">
            <img src="@/assets/images/profile.jpeg" />
            <div class="loungeBodyUsersCardContent">
              <h1>Peeka<span>P13Ka</span></h1>
              <p>I am almost bronze lol, so close</p>
            </div>
          </div>
        </div>

        <div class="loungeBodyChat">
          <div class="loungeMessagesFeed">
            <ul>
              <li class="loungeMessageReceived"><div class="loungeMessageIcon">
                <img
                  src="data:image/jpeg;base64,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"
                />
              </div>
              <div class="loungeMessageText">
                <p>i am doing greatg un</p><span>07/07/2020 - 09:16</span>
                <span></span>
              </div></li>
              <li class="loungeMessageSent"><div class="loungeMessageIcon">
                <img
                  src="data:image/jpeg;base64,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"
                />
              </div>
              <div class="loungeMessageText">
                <p>i am doing greatg un</p><span>07/07/2020 - 09:16</span>
              </div></li>
            </ul>
          </div>
          <div class="loungeMessageComposer">
            <textarea placeholder="Message ..."></textarea>
          </div>
        </div>
      </div>
      <div class="loungeButtons">
        <button>REVEAL</button>
        <button>LEAVE</button>
      </div>
    </div>
  </div>
</template>

<script>
import { getQueueGames, queue } from "@/services/queue.api";

import Lounge from "@/components/Lounge";

export default {
  name: "Queue",
  data() {
    return {
      childMessage: "",
      mainComponent: null,
      queuegames: [],
      firstOption: "",
      secondOption: "",
      lobby: "",
      errors: [],
    };
  },
  computed: {
    option: function() {
      console.log(this.queuegames[this.firstOption]);
      return this.queuegames[this.firstOption];
    },
  },
  methods: {
    async lounge() {
      this.errors = [];
      try {
        if(!this.queuegames[this.firstOption]) {
            this.errors.push('Please select a game!');
        } if (!this.queuegames[this.firstOption].options[this.secondOption]) {
            this.errors.push('Please select an option');
        } else {

          let loungeName = this.queuegames[this.firstOption].name + " [" + this.queuegames[this.firstOption].options[this.secondOption].name + "]";
          let loungeCode = this.firstOption + "-" + this.queuegames[this.firstOption].options[this.secondOption].id;

          let lounge = {
            name: loungeName,
            code: loungeCode,
          };

          this.lobby = lounge;

          await queue(lounge).then((response) => {
            console.log(response.data);
            this.$store
            .dispatch("notification", {
              message: response.data.response,
            })
            .then(() => {
              //this.emitToDashboard('posts')
            })
            .catch((errors) => {
              console.log(errors);
            });

            this.lobby.id = response.data.data;

            this.name = null;
            this.code = null;

            // the lounge component is visible to do:
            if (this.mainComponent == null) {
              this.mainComponent = Lounge;
            } else {
              this.mainComponent = null;
            }

          });
        }
      } catch (errors) {
          let err = errors.response.data.errors;
          console.log(errors);
          if(err.name) {
            this.errors.push(err.name[0] )
          }
          if(err.code) {
            this.errors.push(err.code[0] )
          }
      }



    },
  },
  async mounted() {
    try {
      const response = await getQueueGames();
      this.queuegames = response.data;

      //console.log(this.queuegames);
    } catch (error) {
      console.log(error);
    }
  },
};
</script>

<style></style>
