<template>
  <div class="user-details-container">
    <img :alt="image_alt" :src="image_src" class="user-details-image" />
    <div class="user-details-container1">
      <span class="user-details-text textSM">{{ name }}</span>
      <div class="user-details-container2">
        <span class="user-details-text1 textXS">
          Published
          <span v-html="raw6its"></span>
        </span>
        <span class="user-details-text2 textXS">{{ time }}</span>
        <span class="user-details-text3 textXS">ago</span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'UserDetails',
  props: {
    image_src: {
      type: String,
      default: '/playground_assets/team4-200h.png',
    },
    name: {
      type: String,
      default: 'Laura Hanks',
    },
    time: {
      type: String,
      default: '3 days',
    },
    image_alt: {
      type: String,
      default: 'image',
    },
  },

  data() {
    return {
      raw6its: ' ',
    }
  },
}
</script>

<style scoped>
.user-details-container {
  flex: 0 0 auto;
  display: flex;
  align-items: flex-start;
  flex-direction: row;
}
.user-details-image {
  width: 40px;
  object-fit: cover;
  margin-right: var(--dl-space-space-unit);
  border-radius: var(--dl-radius-radius-round);
}
.user-details-container1 {
  flex: 0 0 auto;
  display: flex;
  align-items: flex-start;
  flex-direction: column;
}
.user-details-text {
  color: var(--dl-color-secondary-500);
  font-weight: 700;
  text-transform: uppercase;
}
.user-details-container2 {
  display: flex;
  align-items: flex-start;
  flex-direction: row;
}
.user-details-text1 {
  color: var(--dl-color-secondary-500);
  font-weight: 400;
  margin-right: 0.25rem;
}
.user-details-text2 {
  color: var(--dl-color-secondary-500);
  font-weight: 400;
}
.user-details-text3 {
  color: var(--dl-color-secondary-500);
  font-weight: 400;
  margin-left: 0.25rem;
}
</style>
