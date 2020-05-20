<template>
  <div class="news">News component {{ data }}</div>
</template>

<script>
export default {
  name: "News",
  props: {
    data: {
      type: Object,
      default: () => {
        return {};
      }
    }
  }
};
</script>

<style></style>
