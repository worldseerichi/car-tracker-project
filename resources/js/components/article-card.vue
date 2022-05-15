<template>
  <div class="article-card-container">
    <img :alt="image_alt" :src="image_src" class="article-card-image" />
    <div class="article-card-container1">
      <h3 class="article-card-text healine">{{ title }}</h3>
      <div class="article-card-container2">
        <span class="article-card-text1">{{ description }}</span>
      </div>
      <div class="article-card-container3">
        <img :alt="avatar_alt" :src="avatar_src" class="article-card-image1" />
        <div class="article-card-container4">
          <span class="article-card-text2">{{ name }}</span>
          <div class="article-card-container5">
            <span class="article-card-text3 textSM">{{ time }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ArticleCard',
  props: {
    avatar_src: {
      type: String,
      default: '15958451-f790-4024-a70e-cc38b82637f2',
    },
    name: {
      type: String,
      default: 'Laura Hanks',
    },
    title: {
      type: String,
      default: 'Portofino one of the best for remote working',
    },
    image_src: {
      type: String,
      default: '/playground_assets/city-1-1400w.jpg',
    },
    time: {
      type: String,
      default: 'Published 3 days ago',
    },
    avatar_alt: {
      type: String,
      default: 'avatar',
    },
    description: {
      type: String,
      default:
        "Finding temporary housing should be as easy as renting an Airbnb. That's th e idea behinf portofino, which raised $65 million to expand its pet sitting businesses. This come as the right move for the investment while the planet is moving on work from home...",
    },
    image_alt: {
      type: String,
      default: 'image',
    },
  },
}
</script>

<style scoped>
.article-card-container {
  flex: 0 0 auto;
  width: 90%;
  display: flex;
  box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1),0 4px 6px -2px rgba(0,0,0,0.05);
  align-items: center;
  border-radius: var(--dl-radius-radius-radius75);
  margin-bottom: var(--dl-space-space-doubleunit);
  flex-direction: row;
}
.article-card-image {
  width: 33%;
  object-fit: cover;
  border-radius: 0px;
  border-top-left-radius: var(--dl-radius-radius-radius75);
  border-bottom-left-radius: var(--dl-radius-radius-radius75);
}
.article-card-container1 {
  flex: 1;
  width: 100%;
  display: flex;
  padding: var(--dl-space-space-unit);
  align-items: flex-start;
  flex-direction: column;
}
.article-card-text {
  color: var(--dl-color-secondary-300);
  font-weight: 600;
}
.article-card-container2 {
  display: flex;
  align-items: flex-start;
  flex-direction: column;
}
.article-card-text1 {
  color: var(--dl-color-secondary-500);
  font-size: 1.125rem;
  font-weight: 300;
  margin-bottom: var(--dl-space-space-doubleunit);
}
.article-card-container3 {
  flex: 0 0 auto;
  display: flex;
  align-items: flex-start;
  flex-direction: row;
}
.article-card-image1 {
  width: 48px;
  object-fit: cover;
  margin-right: var(--dl-space-space-unit);
  border-radius: var(--dl-radius-radius-round);
}
.article-card-container4 {
  flex: 0 0 auto;
  display: flex;
  align-items: flex-start;
  flex-direction: column;
}
.article-card-text2 {
  color: var(--dl-color-secondary-500);
  font-size: 1rem;
  font-weight: 700;
  text-transform: uppercase;
}
.article-card-container5 {
  display: flex;
  align-items: flex-start;
  flex-direction: row;
}
.article-card-text3 {
  color: var(--dl-color-secondary-500);
}
@media(max-width: 991px) {
  .article-card-container {
    flex-direction: column;
  }
  .article-card-image {
    width: 100%;
    margin-bottom: var(--dl-space-space-unit);
  }
}
</style>
