<template>
  <div>
    <p>this is where the list forum will come</p>
  </div>
</template>

<script>
import { authComputed } from "../store/helpers.js";

export default {
  computed: {
    ...authComputed
  }
};
</script>
