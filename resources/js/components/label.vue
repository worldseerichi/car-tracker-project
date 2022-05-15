<template>
  <div class="label-container"><h6 class="label-text">{{ text }}</h6></div>
</template>

<script>
export default {
  name: 'Label',
  props: {
    text: {
      type: String,
      default: 'Text',
    },
  },
}
</script>

<style scoped>
.label-container {
  display: flex;
  position: relative;
}
.label-text {
  color: var(--dl-color-pimary-500);
  font-style: normal;
  font-weight: 700;
  line-height: 1;
  padding-top: 0.25rem;
  padding-left: var(--dl-space-space-halfunit);
  border-radius: var(--dl-radius-radius-radius25);
  padding-right: var(--dl-space-space-halfunit);
  padding-bottom: 0.25rem;
  text-transform: uppercase;
  background-color: var(--dl-color-pimary-700);
}
</style>
