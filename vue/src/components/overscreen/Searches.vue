<template>
    <div class="usersearches">
        <div class="usersearchCard">
                <div class="usersearchCardImage" v-if="searchedUser.image">
                        <img :src="searchedUser.image" />
                </div>
                <div class="usersearchCardImage" v-else>
                    <img src="@/assets/images/profile.jpeg" />
                </div>
                <div class="usersearchCardUser">
                    <p>{{ searchedUser.username }}</p>
                    <p>{{ searchedUser.email }}</p>
                </div>
                <div class="usersearchCardLink">onForumPostCardClick
                    <a  @click="onProfileClick" v-on:click="emitToUserSearch">  <i class="fas fa-arrow-right"></i> </a>
                </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        searchedUser: {
            type: Object,
            default: () => {
                return {};
            }
        }
    },
    data() {
        return {
            users: []
        };
    },

    async mounted() {
        /* try {
      const response = await getAllFriends();
      this.friends = response.data;

      // adds friends to either online of offline array :)
      this.friends.forEach(item => {
        if (item.status.name == "online") {
          this.onlineFriends.push(item);
        }
        if (item.status.name == "offline") {
          this.offlineFriends.push(item);
        }
      });
      //console.log(this.offlineFriends);
      //console.log(this.onlineFriends);
    } catch (error) {
      console.log(error);
    }*/
    },
    methods: {
          onProfileClick() {
            this.childMessage = {
                component: "Profile",
                id: this.searchedUser.id
            }
                 
            this.emitToUserSearch(this.childMessage);
        },
        emitToUserSearch(value) {
            this.$emit("emitToUserSearch", value);
        }
    }
};
</script>

<style lang="scss"></style>
