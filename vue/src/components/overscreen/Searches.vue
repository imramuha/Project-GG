<template>
    <div class="usersearches">
        <div class="friendlistCard">
            <router-link :to="{ name: 'profile', params: { id: searchedUser.id } }">
                <div class="friendlistCardImg">
                    <img :src="searchedUser.image" />
                </div>
                <div class="searchedUserlistCardUser">
                    <p>{{ searchedUser.username }}</p>
                    <p>{{ searchedUser.email }}</p>
                </div>
                <div class="friendlistCardStatus">
                    <div class="statusCircle"></div>
                </div>
            </router-link>
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
    }
};
</script>

<style lang="scss"></style>
