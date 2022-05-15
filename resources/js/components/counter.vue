<template>
  <div class="counter-container">
    <h1 class="counter-text textXL">{{ number }}</h1>
    <span class="counter-text1 textSM">{{ type }}</span>
  </div>
</template>

<script>
export default {
  name: 'Counter',
  props: {
    type: {
      type: String,
      default: 'Friends',
    },
    number: {
      type: String,
      default: '22',
    },
  },
}
</script>

<style scoped>
.counter-container {
  flex: 0 0 auto;
  display: flex;
  padding: var(--dl-space-space-halfunit);
  align-items: center;
  flex-direction: column;
}
.counter-text {
  color: var(--dl-color-secondary-400);
  font-weight: 600;
}
.counter-text1 {
  color: var(--dl-color-secondary-500);
}
</style>
