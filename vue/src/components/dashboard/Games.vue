<template>
  <div class="gamesContainer">
    <div class="games">
      <GameCard
        v-for="usergame in usergames"
        v-bind:key="usergame.id"
        :game="usergame"
      />
    </div>
    <div class="gamesFooter">
      <div class="gamesPagination">
        <button
          v-on:click="fetchPaginatedGames(pagination.prevPage)"
          :disabled="!pagination.prevPage"
        >
           <i class="fa fa-arrow-left" aria-hidden="true" />
        </button>
        <p>Page <span>{{ pagination.currentPage }}</span> of <span>{{ pagination.lastPage }}</span></p>
        <button
          v-on:click="fetchPaginatedGames(pagination.nextPage)"
          :disabled="!pagination.nextPage"
        > 
            <i class="fa fa-arrow-right" aria-hidden="true" />
        </button>
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
      pagination: []
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
    }
  },

  async mounted() {
    console.log(this.getUserGames.length);
    if (this.getUserGames.length === 0) {
      await this.fetchUserGames(this.url);

      this.usergames = this.getUserGames.data;
      this.createPagination(this.getUserGames);

      console.log(this.pagination);
    } else {
      this.usergames = this.getUserGames.data;
      this.createPagination(this.usergames);
    }
  }
};
</script>

<style></style>
