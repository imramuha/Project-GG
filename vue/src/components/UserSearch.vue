<template>
    <div class="usersearch">
        <Searches
            v-for="searchedUser in searchedUsers"
            v-bind:key="searchedUser.id"
            :searchedUser="searchedUser"
             v-on:emitToUserSearch="onSearchedUserCardClick"
        />
    </div>
</template>

<script>

import Searches from "@/components/overscreen/Searches";

import { searchUsers } from "@/services/user.api";

export default {
    components: {
      Searches,
    },
    props: ["data"],
    data() {
      return {
        searchedUsers: [],
      }
    },
    async mounted() {    
      const formData = new FormData();
      formData.append('searchTerm', this.data);
      console.log(formData);
      try {
          let response = await searchUsers(formData);

          this.searchedUsers = response.data.users;

          this.searchTerm = null;
      } catch (error) {
          console.log(error);
      }
    },
    methods: {
      onSearchedUserCardClick(value) {
        this.emitToOverscreen(value);
      },
      emitToOverscreen(value) {
        this.$emit("emitToOverscreen", value);
      },
    }
};
</script>

<style></style>
