<template>
  <div class="g-p-s1-container">
    <div class="g-p-s1-image">
      <app-header rootClassName="header-root-class-name5"></app-header>
    </div>
    <div class="g-p-s1-container1">
      <span class="g-p-s1-text">User Managment</span>
    </div>
    <div class="g-p-s1-container2"></div>
    <div class="g-p-s1-container3">
      <span class="g-p-s1-text01">Create new User</span>
      <div class="g-p-s1-container4">
        <label class="g-p-s1-text02">
          <span>
            username :
            <span v-html="raw04vt"></span>
          </span>
        </label>
        <input
          type="text"
          placeholder="placeholder"
          class="g-p-s1-textinput input"
        />
      </div>
      <div class="g-p-s1-container5">
        <label class="g-p-s1-text04">
          <span>
            password :
            <span v-html="rawa29k"></span>
          </span>
        </label>
        <input
          type="text"
          placeholder="placeholder"
          class="g-p-s1-textinput1 input"
        />
      </div>
      <button class="g-p-s1-button button">
        <span class="g-p-s1-text06">
          <span class="g-p-s1-text07">Create Account</span>
          <br />
          <span></span>
        </span>
      </button>
    </div>
  </div>
</template>

<script>
import AppHeader from '../components/header'

export default {
  name: 'GPS1',
  components: {
    AppHeader,
  },

  data() {
    return {
      raw04vt: ' ',
      rawa29k: ' ',
    }
  },

  metaInfo: {
    title: 'GPS1 - Car_Tracker_V1',
    meta: [
      {
        property: 'og:title',
        content: 'GPS1 - Car_Tracker_V1',
      },
    ],
  },
}
</script>

<style scoped>
.g-p-s1-container {
  width: 100%;
  height: auto;
  display: flex;
  min-height: 100vh;
  align-items: center;
  flex-direction: column;
  justify-content: flex-start;
  background-color: #f2f5f9ff;
}
.g-p-s1-image {
  width: 100%;
  height: 82px;
  display: flex;
  position: relative;
  align-items: center;
  flex-direction: column;
  background-size: cover;
}
.g-p-s1-container1 {
  flex: 0 0 auto;
  width: 100%;
  height: 100px;
  display: flex;
  align-items: stretch;
  justify-content: center;
}
.g-p-s1-text {
  color: var(--dl-color-gray-black);
  font-size: 1.5rem;
  align-self: center;
  font-style: normal;
  text-align: center;
  font-weight: 700;
  text-transform: capitalize;
}
.g-p-s1-container2 {
  width: 100%;
  border: 2px dashed rgba(120, 120, 120, 0.4);
  height: 355px;
  display: flex;
  align-items: flex-start;
  flex-direction: column;
}
.g-p-s1-container3 {
  width: 100%;
  height: 229px;
  display: flex;
  align-items: flex-start;
  flex-direction: column;
}
.g-p-s1-text01 {
  color: var(--dl-color-gray-black);
  font-size: 1.2rem;
  align-self: center;
  font-style: normal;
  text-align: center;
  font-weight: 700;
  text-transform: capitalize;
}
.g-p-s1-container4 {
  flex: 0 0 auto;
  width: auto;
  height: auto;
  display: flex;
  align-self: center;
  margin-top: 5px;
  align-items: flex-start;
  margin-bottom: 5px;
  justify-content: flex-start;
}
.g-p-s1-text02 {
  color: #000000;
  font-size: 1rem;
  align-self: center;
  font-style: normal;
  font-weight: 400;
  padding-right: 5px;
  text-transform: lowercase;
}
.g-p-s1-textinput {
  width: 291px;
  height: 41px;
  align-self: center;
  text-align: center;
}
.g-p-s1-container5 {
  flex: 0 0 auto;
  width: auto;
  height: auto;
  display: flex;
  align-self: center;
  align-items: flex-start;
  padding-top: 5px;
  padding-bottom: 5px;
  justify-content: center;
}
.g-p-s1-text04 {
  color: #000000;
  font-size: 1rem;
  align-self: center;
  font-style: normal;
  font-weight: 400;
  padding-right: 5px;
  text-transform: lowercase;
}
.g-p-s1-textinput1 {
  width: 291px;
  height: 41px;
  align-self: center;
  text-align: center;
}
.g-p-s1-button {
  width: 274px;
  height: 54px;
  display: flex;
  position: relative;
  align-self: center;
  text-align: center;
  align-items: center;
  padding-top: 0px;
  flex-direction: row;
  padding-bottom: 0px;
  justify-content: center;
  background-color: #61ea5c;
}
.g-p-s1-text06 {
  color: #000000;
  font-size: 0.7rem;
  align-self: stretch;
  font-style: normal;
  font-weight: 700;
  padding-top: 0.3rem;
  padding-left: 1.3rem;
  padding-right: 1.3rem;
  padding-bottom: 0.3rem;
}
.g-p-s1-text07 {
  font-style: normal;
  font-weight: 400;
}
</style>
