<template>
  <div class="gamesContainer">
    <div v-if="loading" class="ldsContainer">
      <div class="ldsRipple"><div></div><div></div></div>
    </div>
    
    <div v-if="usergames && !loading" class="games">
      <GameCard
        v-for="usergame in usergames"
        v-bind:key="usergame.id"
        :game="usergame"
        v-on:emitToGames="reloadGames"
      />
    </div>
    <div v-if="!usergames.length && !loading" class="games"><h1 class="emptyGames">Sorry, but no games were found, try adding one.</h1></div>
    <div class="gamesFooter">
      <div v-if="pagination.lastPage > 1" class="gamesPagination">
        <button
          v-on:click="fetchPaginatedGames(pagination.prevPage)"
          :disabled="!pagination.prevPage"
        >
          <i class="fa fa-arrow-left" aria-hidden="true" />
        </button>
        <p>
          Page <span>{{ pagination.currentPage }}</span> of
          <span>{{ pagination.lastPage }}</span>
        </p>
        <button
          v-on:click="fetchPaginatedGames(pagination.nextPage)"
          :disabled="!pagination.nextPage"
        >
          <i class="fa fa-arrow-right" aria-hidden="true" />
        </button>
      </div>
      <div v-else class="gamesPagination">
      </div>
      <div class="gamesFooterButtons">
        <a v-on:click="onClickAdd">
          <button>Add</button>
        </a>
      </div>
    </div>
  </div>
</template>

<script>
import GameCard from "@/components/GameCard";

import { mapActions, mapGetters } from "vuex";

export default {
  components: { GameCard },
  data() {
    return {
      isLoading: true,
      usergames: [],
      url: "/api/frontend/usergames",
      pagination: [],
      loading: true,
    };
  },
  computed: {
    ...mapGetters("Game", ["getUserGames"])
  },
  methods: {
    ...mapActions("Game", ["fetchUserGames"]),

    createPagination(data) {
      console.log(data);
      let pagination = {
        currentPage: data.current_page,
        lastPage: data.last_page,
        nextPage: data.next_page_url,
        prevPage: data.prev_page_url
      };
      this.pagination = pagination;
    },

    async fetchPaginatedGames(url) {
      console.log(url);
      this.url = url;

      await this.fetchUserGames(this.url);
      this.usergames = this.getUserGames.data;
      this.createPagination(this.getUserGames);
    },
    onClickAdd() {
      let value = {
        component: "UserGameAdd"
      };
      this.emitToOverscreen(value);
    },
    emitToOverscreen(value) {
      this.$emit("emitToOverscreen", value);
    },
    async reloadGames() {
      console.log('hiiii');
      if (!this.getUserGames.length) {
        await this.fetchUserGames(this.url);

        this.usergames = this.getUserGames.data;
        this.createPagination(this.getUserGames);

        this.loading = false;
      } else {
        this.usergames = this.getUserGames.data;
        this.createPagination(this.usergames);
        this.loading = false;
      }
    }
  },

  async mounted() {
    if (!this.getUserGames.length) {
      await this.fetchUserGames(this.url);

      this.usergames = this.getUserGames.data;
      this.createPagination(this.getUserGames);

      this.loading = false;
    } else {
      this.usergames = this.getUserGames.data;
      this.createPagination(this.usergames);
      this.loading = false;
    }
  }
};
</script>

<style></style>
