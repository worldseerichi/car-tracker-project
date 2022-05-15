<template>
  <div class="member-details-container">
    <img :alt="image_alt" :src="image_src" class="member-details-image" />
    <h1 class="member-details-text textXL">{{ heading1 }}</h1>
    <h1 class="member-details-text1 textSM">{{ heading11 }}</h1>
  </div>
</template>

<script>
export default {
  name: 'MemberDetails',
  props: {
    heading11: {
      type: String,
      default: 'WEB DEVELOPER',
    },
    heading1: {
      type: String,
      default: 'Ryan Tompson',
    },
    image_alt: {
      type: String,
      default: 'image',
    },
    image_src: {
      type: String,
      default:
        'https://demos.creative-tim.com/notus-pro-react/static/media/team-1-800x800.fa5a7ac2.jpg',
    },
  },
}
</script>

<style scoped>
.member-details-container {
  display: flex;
  align-items: center;
  flex-direction: column;
  justify-content: center;
}
.member-details-image {
  width: 100px;
  box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1),0 4px 6px -2px rgba(0,0,0,0.05);
  object-fit: cover;
  border-radius: var(--dl-radius-radius-round);
}
.member-details-text {
  color: var(--dl-color-secondary-100);
  text-align: center;
  padding-top: var(--dl-space-space-unitandhalf);
}
.member-details-text1 {
  color: var(--dl-color-secondary-700);
  text-align: center;
  text-transform: uppercase;
}
</style>
