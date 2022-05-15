<template>
  <div class="whodis-container"></div>
</template>

<script>
export default {
  name: 'Whodis',
  metaInfo: {
    title: 'who dis - Car_Tracker_V1',
    meta: [
      {
        property: 'og:title',
        content: 'who dis - Car_Tracker_V1',
      },
    ],
  },
}
</script>

<style scoped>
.whodis-container {
  width: 100%;
  display: flex;
  overflow: auto;
  min-height: 100vh;
  align-items: center;
  flex-direction: column;
}
</style>
