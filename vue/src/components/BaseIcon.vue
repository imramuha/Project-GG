<template>
  <div class="icon-wrapper">
    <svg class="icon" :width="width" :height="height">
      <use v-bind="{ 'xlink:href': '/feather-sprite.svg#' + name }" />
      // notice +name here
    </svg>
    <slot name="tagline"></slot>
    <slot name="status"></slot>
  </div>
</template>

<script>
export default {
  props: {
    name: String,
    width: {
      type: [String, Number],
      default: 24
    },
    height: {
      type: [String, Number],
      default: 24
    }
  }
};
</script>

<style></style>
