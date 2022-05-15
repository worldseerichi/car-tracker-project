<template>
  <div class="home-container">
    <div class="home-hero">
      <div class="home-bg"></div>
      <app-header rootClassName="rootClassName1"></app-header>
      <div class="home-container1">
        <div class="home-container2">
          <h1 class="home-text">
            <span>Vehicle </span>
            <span>Tracking 2022</span>
          </h1>
          <span class="home-text3">
            <span>*Tex</span>
            <span>to de exemplo de descrição*</span>
            <span></span>
          </span>
          <router-link to="/g-p-s" class="home-navlink button">
            <span class="home-text7"><span>Start Tracking</span></span>
          </router-link>
        </div>
        <img
          alt="image"
          src="../playground_assets/gray-vector.svg"
          class="home-image"
        />
        <img
          alt="image"
          src="../playground_assets/white-vector.svg"
          class="home-image1"
        />
      </div>
    </div>
    <app-footer></app-footer>
  </div>
</template>

<script>
import AppHeader from '../components/header'
import AppFooter from '../components/footer'

export default {
  name: 'Home',
  components: {
    AppHeader,
    AppFooter,
  },
  metaInfo: {
    title: 'Vehicle Tracker',
    meta: [
      {
        property: 'og:title',
        content: 'Car_Tracker_V1',
      },
    ],
  },
}
</script>

<style scoped>
.home-container {
  width: 100%;
  height: auto;
  display: flex;
  min-height: 100vh;
  align-items: flex-start;
  flex-direction: column;
}
.home-hero {
  flex: 0 0 auto;
  width: 100%;
  height: 80vh;
  display: flex;
  position: relative;
  align-items: center;
  flex-direction: column;
  background-size: cover;
  background-image: url('https://cdn.discordapp.com/attachments/890206760051281950/959950345306513489/unknown.png');
}
.home-bg {
  width: 100%;
  height: 70px;
  display: flex;
  opacity: 0.7;
  position: absolute;
  align-items: flex-start;
  flex-direction: column;
  background-color: var(--dl-color-gray-black);
}
.home-container1 {
  left: 0px;
  width: 100%;
  bottom: 0px;
  height: 100%;
  display: flex;
  position: absolute;
  align-items: center;
  flex-direction: column;
  justify-content: center;
}
.home-container2 {
  width: 672px;
  height: 321px;
  display: flex;
  align-items: center;
  padding-left: var(--dl-space-space-tripleunit);
  border-radius: var(--dl-radius-radius-round);
  padding-right: var(--dl-space-space-tripleunit);
  flex-direction: column;
  justify-content: center;
  background-color: rgba(0, 0, 0, 0.28);
  border-top-left-radius: var(--dl-radius-radius-round);
  border-top-right-radius: var(--dl-radius-radius-round);
  border-bottom-left-radius: var(--dl-radius-radius-round);
  border-bottom-right-radius: var(--dl-radius-radius-round);
}
.home-text {
  color: var(--dl-color-gray-white);
  text-align: center;
}
.home-text3 {
  color: #ffffff;
  max-width: 600px;
  text-align: center;
  padding-top: var(--dl-space-space-triplequarter);
  padding-bottom: var(--dl-space-space-triplequarter);
}
.home-navlink {
  color: #ffffff;
  width: 163px;
  height: 53px;
  display: flex;
  position: relative;
  text-align: center;
  font-family: Arial;
  border-width: 0px;
  border-radius: 60%;
  flex-direction: row;
  text-decoration: none;
  background-color: #34da38;
}
.home-text7 {
  left: 18px;
  right: 18px;
  position: absolute;
  align-self: center;
  font-style: normal;
  text-align: center;
  font-weight: 700;
  line-height: -2;
}
.home-image {
  top: auto;
  left: auto;
  right: 0px;
  width: 100%;
  bottom: -1px;
  position: absolute;
  object-fit: cover;
}
.home-image1 {
  left: auto;
  right: 0px;
  width: 100%;
  bottom: 0px;
  height: 50px;
  position: absolute;
  object-fit: cover;
}
@media(max-width: 479px) {
  .home-container2 {
    padding-left: var(--dl-space-space-doubleunit);
    padding-right: var(--dl-space-space-doubleunit);
  }
}
</style>
