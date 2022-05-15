<template>
  <div class="service-card-container">
    <div class="service-card-container1">
      <svg viewBox="0 0 1024 1024" class="service-card-icon">
        <path
          d="M512 86q124 0 211 87t87 211q0 150-128 244v98q0 18-12 30t-30 12h-256q-18 0-30-12t-12-30v-98q-128-88-128-244 0-124 87-211t211-87zM384 896v-42h256v42q0 18-12 30t-30 12h-172q-18 0-30-12t-12-30z"
        ></path>
      </svg>
    </div>
    <h1 class="service-card-text textXL">{{ heading }}</h1>
    <span class="service-card-text1">{{ text }}</span>
  </div>
</template>

<script>
export default {
  name: 'ServiceCard',
  props: {
    text: {
      type: String,
      default:
        "Some quick example text to build on the card title and make up the bulk of the card's content.",
    },
    heading: {
      type: String,
      default: 'Excelent services',
    },
  },
}
</script>

<style scoped>
.service-card-container {
  flex: 0 0 auto;
  width: 30%;
  display: flex;
  align-items: center;
  padding-left: var(--dl-space-space-unit);
  padding-right: var(--dl-space-space-unit);
  flex-direction: column;
}
.service-card-container1 {
  flex: 0 0 auto;
  width: 48px;
  height: 48px;
  display: flex;
  align-items: center;
  border-radius: var(--dl-radius-radius-round);
  flex-direction: column;
  justify-content: center;
  background-color: #f2f5f9ff;
}
.service-card-icon {
  fill: var(--dl-color-secondary-100);
  width: 24px;
  height: 24px;
}
.service-card-text {
  color: var(--dl-color-gray-white);
  margin-top: var(--dl-space-space-unitandhalf);
  font-weight: 600;
}
.service-card-text1 {
  color: var(--dl-color-secondary-500);
  font-size: 1.25rem;
  text-align: center;
}
@media(max-width: 991px) {
  .service-card-container {
    width: 100%;
    padding-bottom: var(--dl-space-space-doubleunit);
  }
}
</style>
