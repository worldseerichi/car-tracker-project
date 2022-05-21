<template>
  <div class="register-accounts-container">
    <div class="register-accounts-image">
      <app-header></app-header>
      <img
        alt="image"
        src="../playground_assets/gray-vector.svg"
        class="register-accounts-image1"
      />
      <div class="register-accounts-bg"></div>
    </div>
    <div class="register-accounts-container1">
      <div class="register-accounts-container2">
        <div class="register-accounts-container3"></div>
      </div>
      <div class="register-accounts-container4">
        <span class="register-accounts-text">
          <span class="register-accounts-text1">ADMIN DASHBOARD</span>
          <br />
          <span>ACCOUNT CREATION</span>
        </span>
        <label class="register-accounts-text4">Username</label>
        <input
          type="text"
          placeholder="username"
          class="register-accounts-textinput input"
        />
        <label class="register-accounts-text5">Password</label>
        <input
          type="password"
          placeholder="password"
          class="register-accounts-textinput1 input"
        />
        <button class="register-accounts-button button">
          <span class="register-accounts-text6"><span>Register</span></span>
        </button>
      </div>
    </div>
    <app-footer></app-footer>
  </div>
</template>

<script>
import AppHeader from '../components/header'
import AppFooter from '../components/footer'

export default {
  name: 'RegisterAccounts',
  components: {
    AppHeader,
    AppFooter,
  },
  metaInfo: {
    title: 'RegisterAccounts - Car_Tracker_V1',
    meta: [
      {
        property: 'og:title',
        content: 'RegisterAccounts - Car_Tracker_V1',
      },
    ],
  },
}
</script>

<style scoped>
.register-accounts-container {
  width: 100%;
  height: auto;
  display: flex;
  min-height: 100vh;
  align-items: center;
  flex-direction: column;
  justify-content: flex-start;
  background-color: #f2f5f9ff;
}
.register-accounts-image {
  width: 100%;
  height: 301px;
  display: flex;
  position: relative;
  align-items: center;
  flex-direction: column;
  background-size: cover;
  background-image: url('https://images.unsplash.com/photo-1499336315816-097655dcfbda?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1500&q=80');
}
.register-accounts-image1 {
  left: auto;
  right: auto;
  width: 100%;
  bottom: -1px;
  z-index: 100;
  position: absolute;
  object-fit: cover;
}
.register-accounts-bg {
  top: auto;
  flex: 0 0 auto;
  left: auto;
  right: 0px;
  width: 100%;
  bottom: auto;
  height: 100%;
  display: flex;
  opacity: 0.5;
  position: absolute;
  align-items: flex-start;
  flex-direction: column;
  background-color: var(--dl-color-gray-black);
}
.register-accounts-container1 {
  width: 85%;
  height: 623px;
  display: flex;
  z-index: 100;
  box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1),0 10px 10px -5px rgba(0,0,0,0.04);
  margin-top: -12rem;
  align-items: flex-start;
  border-radius: var(--dl-radius-radius-radius75);
  margin-bottom: var(--dl-space-space-tripleunit);
  flex-direction: column;
  background-color: var(--dl-color-gray-white);
}
.register-accounts-container2 {
  width: 100%;
  height: 35px;
  display: flex;
  align-items: center;
  flex-direction: column;
}
.register-accounts-container3 {
  flex: 0 0 auto;
  border: 2px dashed rgba(120, 120, 120, 0.4);
  display: flex;
  align-items: center;
  flex-direction: row;
  justify-content: center;
}
.register-accounts-container4 {
  width: 100%;
  height: 415px;
  display: flex;
  position: relative;
  margin-top: 4.5rem;
  align-items: flex-end;
  border-color: var(--dl-color-gray-900);
  border-style: dashed;
  border-width: 2px;
  margin-bottom: 20rem;
  flex-direction: column;
  justify-content: flex-end;
}
.register-accounts-text {
  color: #000000;
  align-self: stretch;
  font-style: normal;
  margin-top: 2rem;
  text-align: center;
  font-weight: 700;
  margin-left: 0px;
  margin-right: 0px;
  text-transform: uppercase;
}
.register-accounts-text1 {
  font-style: normal;
  font-weight: 700;
}
.register-accounts-text4 {
  color: #000000;
  align-self: center;
  font-style: normal;
  margin-top: 1rem;
  font-weight: 700;
}
.register-accounts-textinput {
  width: 339px;
  align-self: center;
}
.register-accounts-text5 {
  color: #000000;
  align-self: center;
  font-style: normal;
  font-weight: 700;
}
.register-accounts-textinput1 {
  width: 339px;
  align-self: center;
  margin-bottom: 1rem;
}
.register-accounts-button {
  width: 148px;
  height: 41px;
  display: flex;
  position: relative;
  align-self: center;
  padding-top: 0px;
  margin-bottom: 1rem;
  flex-direction: row;
  padding-bottom: 0px;
  background-color: #61ea5c;
}
.register-accounts-text6 {
  color: #000000;
  align-self: stretch;
  font-style: normal;
  font-weight: 700;
  padding-top: 0.3rem;
  padding-left: 1.3rem;
  padding-right: 1.3rem;
  padding-bottom: 0.3rem;
}
</style>
