<template>
  <div class="post-reaction-container">
    <div class="post-reaction-container1">
      <img :alt="image_alt" :src="image_src" class="post-reaction-image" />
      <div class="post-reaction-container2">
        <span class="post-reaction-text textLG">{{ name }}</span>
        <span class="post-reaction-text1 textMD">{{ text }}</span>
        <div class="post-reaction-container3">
          <svg viewBox="0 0 1024 1024" class="post-reaction-icon">
            <path
              d="M982 426v86q0 16-6 32l-130 300q-20 52-78 52h-384q-34 0-60-26t-26-60v-426q0-34 26-60l280-282 46 46q18 18 18 44v14l-42 196h270q34 0 60 25t26 59zM42 896v-512h172v512h-172z"
            ></path>
          </svg>
          <span class="post-reaction-text2 textXS">{{ likes }}</span>
          <span class="post-reaction-text3 textXS">likes</span>
          <svg viewBox="0 0 1024 1024" class="post-reaction-icon2">
            <path
              d="M1024 365.714c0 9.714-4 18.857-10.857 25.714l-292.571 292.571c-6.857 6.857-16 10.857-25.714 10.857-20 0-36.571-16.571-36.571-36.571v-146.286h-128c-246.286 0-408 47.429-408 320 0 23.429 1.143 46.857 2.857 70.286 0.571 9.143 2.857 19.429 2.857 28.571 0 10.857-6.857 20-18.286 20-8 0-12-4-16-9.714-8.571-12-14.857-30.286-21.143-43.429-32.571-73.143-72.571-177.714-72.571-257.714 0-64 6.286-129.714 30.286-190.286 79.429-197.143 312.571-230.286 500-230.286h128v-146.286c0-20 16.571-36.571 36.571-36.571 9.714 0 18.857 4 25.714 10.857l292.571 292.571c6.857 6.857 10.857 16 10.857 25.714z"
            ></path>
          </svg>
          <span class="post-reaction-text4 textXS">{{ shares }}</span>
          <span class="post-reaction-text5 textXS">shares</span>
        </div>
      </div>
    </div>
    <div class="post-reaction-divider"></div>
  </div>
</template>

<script>
export default {
  name: 'PostReaction',
  props: {
    image_src: {
      type: String,
      default: '/playground_assets/team4-200h.png',
    },
    name: {
      type: String,
      default: 'John Snow',
    },
    image_alt: {
      type: String,
      default: 'image',
    },
    likes: {
      type: String,
      default: '10',
    },
    text: {
      type: String,
      default:
        'You have the opportunity to play this game of life you need to appreciate every moment.',
    },
    shares: {
      type: String,
      default: '2',
    },
  },
}
</script>

<style scoped>
.post-reaction-container {
  flex: 0 0 auto;
  width: 100%;
  display: flex;
  align-items: flex-start;
  padding-top: var(--dl-space-space-unitandhalf);
  flex-direction: column;
  padding-bottom: var(--dl-space-space-unitandhalf);
}
.post-reaction-container1 {
  display: flex;
  align-items: flex-start;
  flex-direction: row;
}
.post-reaction-image {
  width: 40px;
  object-fit: cover;
  margin-right: var(--dl-space-space-unit);
  border-radius: var(--dl-radius-radius-round);
}
.post-reaction-container2 {
  flex: 1;
  display: flex;
  align-items: flex-start;
  flex-direction: column;
}
.post-reaction-text {
  color: var(--dl-color-secondary-400);
  font-weight: 700;
  line-height: 40px;
  margin-bottom: var(--dl-space-space-halfunit);
}
.post-reaction-text1 {
  color: rgba(100, 116, 139,1);
  font-weight: 300;
  line-height: 1.625;
}
.post-reaction-container3 {
  flex: 0 0 auto;
  display: flex;
  margin-top: var(--dl-space-space-halfunit);
  align-items: center;
  flex-direction: row;
}
.post-reaction-icon {
  fill: var(--dl-color-secondary-500);
  width: 14px;
  height: 100%;
}
.post-reaction-text2 {
  color: var(--dl-color-secondary-500);
  margin-left: 0.25rem;
}
.post-reaction-text3 {
  color: var(--dl-color-secondary-500);
  margin-left: 0.25rem;
}
.post-reaction-icon2 {
  fill: var(--dl-color-secondary-500);
  width: 14px;
  margin-top: 2px;
  margin-left: var(--dl-space-space-unit);
}
.post-reaction-text4 {
  color: var(--dl-color-secondary-500);
  margin-left: 0.25rem;
}
.post-reaction-text5 {
  color: var(--dl-color-secondary-500);
  margin-left: 0.25rem;
}
.post-reaction-divider {
  flex: 0 0 auto;
  width: 100%;
  height: 0.5px;
  display: flex;
  opacity: 0.5;
  align-self: center;
  margin-top: var(--dl-space-space-unit);
  align-items: flex-start;
  margin-bottom: var(--dl-space-space-unit);
  flex-direction: column;
  background-color: var(--dl-color-gray-900);
}
</style>
