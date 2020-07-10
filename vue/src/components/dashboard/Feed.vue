<template>
  <div class="feed">
    <div class="feedNews">Feed component {{ data }}</div>
    <div class="feedHistory">
      <ul>
        <li><span>10/07/2020</span> a new game to your collection.</li>
        <li><span>10/06/2020</span>Removed a game from your collection.</li>
        <li><span>10/07/2020</span> a new game to your collection.</li>
        <li><span>10/06/2020</span>Removed a game from your collection.</li>
        <li><span>10/07/2020</span> a new game to your collection.</li>
        <li><span>10/06/2020</span>Removed a game from your collection.</li>
        <li><span>10/07/2020</span> a new game to your collection.</li>
        <li><span>10/06/2020</span>Removed a game from your collection.</li>
        <li><span>10/07/2020</span> a new game to your collection.</li>
        <li><span>10/06/2020</span>Removed a game from your collection.</li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  name: "Feed",
  props: {
    data: {
      type: Object,
      default: () => {
        return {};
      },
    },
  },
};
</script>

<style></style>
