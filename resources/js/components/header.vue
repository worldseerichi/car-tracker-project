<template>
  <div data-role="Header" class="header-header" v-bind:class="rootClassName">
    <div class="header-burger-menu" style="cursor: pointer;" @click="toggleSidebar()">
        <svg viewBox="0 0 1024 1024" class="header-icon17">
            <path
                d="M64 192h896v192h-896zM64 448h896v192h-896zM64 704h896v192h-896z"
            ></path>
        </svg>
    </div>
    <div class="header-container2"></div>
    <div class="header-container3">
        <div class="header-container42" style="cursor: pointer;" @click="toggleSidebar()">
            <svg viewBox="0 0 1024 1024" class="header-icon17">
                <path
                    d="M64 192h896v192h-896zM64 448h896v192h-896zM64 704h896v192h-896z"
                ></path>
            </svg>
        </div>
      <router-link to="/" class="header-navlink2">
        <h1 class="header-heading1 textSM">{{ heading1 }}</h1>
      </router-link>
      <router-link to="/gps" class="header-navlink3">
        <div class="header-container4">
          <svg viewBox="0 0 1024 1024" class="header-icon17">
            <path
              d="M214 470h596l-64-192h-468zM746 682q26 0 45-19t19-45-19-45-45-19-45 19-19 45 19 45 45 19zM278 682q26 0 45-19t19-45-19-45-45-19-45 19-19 45 19 45 45 19zM808 256l88 256v342q0 18-12 30t-30 12h-44q-18 0-30-12t-12-30v-44h-512v44q0 18-12 30t-30 12h-44q-18 0-30-12t-12-30v-342l88-256q12-42 62-42h468q50 0 62 42z"
            ></path>
          </svg>
          <span class="header-text2 textSM">Tracking</span>
        </div>
      </router-link>
      <router-link to="/manageAccounts" class="header-navlink4" v-if="this.$store.getters.getAdminLogged">
        <div class="header-container5">
          <svg viewBox="0 0 1170.2857142857142 1024" class="header-icon19">
            <path
              d="M402.286 512c-121.143 0-219.429-98.286-219.429-219.429s98.286-219.429 219.429-219.429 219.429 98.286 219.429 219.429-98.286 219.429-219.429 219.429zM950.857 585.143h201.143c9.714 0 18.286 8.571 18.286 18.286v109.714c0 9.714-8.571 18.286-18.286 18.286h-201.143v201.143c0 9.714-8.571 18.286-18.286 18.286h-109.714c-9.714 0-18.286-8.571-18.286-18.286v-201.143h-201.143c-9.714 0-18.286-8.571-18.286-18.286v-109.714c0-9.714 8.571-18.286 18.286-18.286h201.143v-201.143c0-9.714 8.571-18.286 18.286-18.286h109.714c9.714 0 18.286 8.571 18.286 18.286v201.143zM530.286 713.143c0 40 33.143 73.143 73.143 73.143h146.286v136c-28 20.571-63.429 28.571-97.714 28.571h-499.429c-91.429 0-152.571-54.857-152.571-148 0-129.143 30.286-327.429 197.714-327.429 9.143 0 15.429 4 22.286 9.714 56 42.857 110.286 69.714 182.286 69.714s126.286-26.857 182.286-69.714c6.857-5.714 13.143-9.714 22.286-9.714 48.571 0 91.429 18.286 124 54.857h-127.429c-40 0-73.143 33.143-73.143 73.143v109.714z"
            ></path>
          </svg>
          <span class="header-text3 textSM"><span>Manage Users</span></span>
        </div>
      </router-link>
    </div>
    <div class="header-container6" v-if="this.$store.getters.getAdminLogged != true">
      <router-link to="/login" class="header-navlink5">
        <div class="header-container7">
          <svg viewBox="0 0 1024 1024" class="header-icon21">
            <path
              d="M512 0c282.857 0 512 229.143 512 512 0 281.143-228 512-512 512-283.429 0-512-230.286-512-512 0-282.857 229.143-512 512-512zM865.714 772c53.143-73.143 85.143-162.857 85.143-260 0-241.714-197.143-438.857-438.857-438.857s-438.857 197.143-438.857 438.857c0 97.143 32 186.857 85.143 260 20.571-102.286 70.286-186.857 174.857-186.857 46.286 45.143 109.143 73.143 178.857 73.143s132.571-28 178.857-73.143c104.571 0 154.286 84.571 174.857 186.857zM731.429 402.286c0-121.143-98.286-219.429-219.429-219.429s-219.429 98.286-219.429 219.429 98.286 219.429 219.429 219.429 219.429-98.286 219.429-219.429z"
            ></path>
          </svg>
          <span class="header-text5 textSM"><span>Login</span></span>
        </div>
      </router-link>
    </div>
    <div class="header-container6" v-if="this.$store.getters.getAdminLogged">
      <!--<router-link to="/" class="header-navlink5"> -->
        <div class="header-container7" id="logout" @click="signout()">
          <svg viewBox="0 0 1024 1024" class="header-icon21">
            <path
              d="M512 0c282.857 0 512 229.143 512 512 0 281.143-228 512-512 512-283.429 0-512-230.286-512-512 0-282.857 229.143-512 512-512zM865.714 772c53.143-73.143 85.143-162.857 85.143-260 0-241.714-197.143-438.857-438.857-438.857s-438.857 197.143-438.857 438.857c0 97.143 32 186.857 85.143 260 20.571-102.286 70.286-186.857 174.857-186.857 46.286 45.143 109.143 73.143 178.857 73.143s132.571-28 178.857-73.143c104.571 0 154.286 84.571 174.857 186.857zM731.429 402.286c0-121.143-98.286-219.429-219.429-219.429s-219.429 98.286-219.429 219.429 98.286 219.429 219.429 219.429 219.429-98.286 219.429-219.429z"
            ></path>
          </svg>
          <span class="header-text5 textSM"><span>Logout</span></span>
        </div>
     <!-- </router-link> -->
    </div>
  </div>
</template>

<script>
export default {
  name: 'Header',
  props: {
    rootClassName: String,
    heading1: {
      type: String,
      default: 'Vehicle Tracker',
    },
  },
  methods: {
      signout(){
        this.$store.commit('storeLogout')
      },
      toggleSidebar() {
        this.$store.commit('toggleSidebar')
      },
  }
}
</script>

<style scoped>
#logout {
    cursor: pointer;
}
.header-header {
  flex: 0 0 auto;
  width: 100%;
  height: 57px;
  display: flex;
  padding: var(--dl-space-space-unitandhalf);
  z-index: 1;
  max-width: 100%;
  align-items: center;
  margin-bottom: 0.75rem;
  flex-direction: row;
  background-color: var(--dl-color-secondary-100);
}
.header-burger-menu {
  display: none;
  align-items: center;
  flex-direction: row;
  justify-content: space-between;
}
.header-icon {
  width: 24px;
  height: 24px;
}
.header-container4, .header-container42 {
  display: flex;
  align-self: center;
  align-items: flex-start;
}
.header-icon17 {
  fill: #ffffff;
  width: 24px;
  height: 24px;
}
.header-mobile-menu {
  top: 0px;
  flex: 0 0 auto;
  left: 0px;
  width: 100%;
  height: 100vh;
  display: none;
  padding: var(--dl-space-space-unitandhalf);
  z-index: 100;
  position: absolute;
  align-items: flex-start;
  flex-direction: column;
  background-color: #fff;
}
.header-top {
  width: 100%;
  display: flex;
  align-items: center;
  margin-bottom: var(--dl-space-space-unit);
  flex-direction: row;
  justify-content: space-between;
}
.header-navlink {
  display: contents;
}
.header-heading {
  color: var(--dl-color-secondary-400);
  font-weight: 700;
  margin-right: var(--dl-space-space-unit);
  text-decoration: none;
}
.header-close-menu {
  display: flex;
  align-items: center;
  flex-direction: row;
  justify-content: space-between;
}
.header-icon02 {
  width: 24px;
  height: 24px;
}
.header-mid {
  display: flex;
  align-items: flex-start;
  flex-direction: column;
  justify-content: space-between;
}
.header-navlink1 {
  display: contents;
}
.header-container {
  display: flex;
  align-items: center;
  margin-bottom: 8px;
  flex-direction: row;
  text-decoration: none;
}
.header-icon04 {
  fill: var(--dl-color-secondary-400);
  width: 13px;
}
.header-text {
  color: var(--dl-color-secondary-400);
  margin-left: var(--dl-space-space-halfunit);
}
.header-container1 {
  display: flex;
  align-items: center;
  flex-direction: row;
  text-decoration: none;
}
.header-icon06 {
  fill: var(--dl-color-secondary-400);
  width: 13px;
}
.header-text1 {
  color: var(--dl-color-secondary-400);
  margin-left: var(--dl-space-space-halfunit);
}
.header-bot {
  flex: 0 0 auto;
  display: flex;
  margin-top: auto;
  align-items: center;
  flex-direction: row;
}
.header-icon11 {
  fill: var(--dl-color-secondary-400);
  width: 24px;
  height: 24px;
  margin-top: var(--dl-space-space-halfunit);
  margin-right: 0.75rem;
  margin-bottom: var(--dl-space-space-halfunit);
}
.header-icon13 {
  fill: var(--dl-color-secondary-400);
  width: 24px;
  height: 24px;
  margin-top: var(--dl-space-space-halfunit);
  margin-left: 0.75rem;
  margin-right: 0.75rem;
  margin-bottom: var(--dl-space-space-halfunit);
}
.header-icon15 {
  fill: var(--dl-color-secondary-400);
  width: 24px;
  height: 24px;
  margin-top: var(--dl-space-space-halfunit);
  margin-left: 0.75rem;
  margin-right: 0.75rem;
  margin-bottom: var(--dl-space-space-halfunit);
}
.header-container2 {
  top: -2px;
  flex: 1;
  left: 421px;
  border: 2px dashed rgba(120, 120, 120, 0.4);
  display: flex;
  position: absolute;
  align-self: flex-end;
  align-items: flex-start;
  flex-direction: row;
  justify-content: center;
}
.header-container3 {
  width: 100%;
  height: 100px;
  display: flex;
  align-items: flex-start;
}
.header-navlink2 {
  display: contents;
}
.header-heading1 {
  color: var(--dl-color-gray-white);
  width: 121px;
  align-self: center;
  text-align: center;
  font-weight: 700;
  margin-left: var(--dl-space-space-halfunit);
  margin-right: 5rem;
  margin-top: 10px;
  text-decoration: none;
}
.header-navlink3 {
  display: contents;
}
.header-container4, .header-container42 {
  display: flex;
  align-self: center;
  align-items: center;
  margin-right: var(--dl-space-space-unit);
  flex-direction: row;
  text-decoration: none;
}
.header-icon17 {
  fill: #D9D9D9;
  width: 24px;
  height: 24px;
}
.header-text2 {
  color: var(--dl-color-gray-white);
  align-self: center;
  margin-left: var(--dl-space-space-halfunit);
}
.header-navlink4 {
  display: contents;
}
.header-container5 {
  display: flex;
  align-self: stretch;
  align-items: center;
  margin-right: var(--dl-space-space-unit);
  flex-direction: row;
  text-decoration: none;
}
.header-icon19 {
  fill: #D9D9D9;
  width: 24px;
  height: 24px;
}
.header-text3 {
  color: var(--dl-color-gray-white);
  align-self: center;
  margin-left: var(--dl-space-space-halfunit);
}
.header-container6 {
  width: 100%;
  height: 100px;
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: flex-end;
}
.header-navlink5 {
  display: contents;
}
.header-container7 {
  display: flex;
  align-self: center;
  align-items: center;
  border-radius: var(--dl-radius-radius-radius4);
  padding-right: var(--dl-space-space-doubleunit);
  flex-direction: row;
  justify-content: space-between;
  text-decoration: none;
}
.header-icon21 {
  fill: #D9D9D9;
  width: 24px;
  height: 24px;
}
.header-text5 {
  color: var(--dl-color-gray-white);
  align-self: center;
  margin-left: var(--dl-space-space-halfunit);
}
.header-root-class-name {
  margin-bottom: 0px;
}
.header-root-class-name1 {
  width: 100%;
  opacity: 1;
  max-width: 100%;
}
.header-root-class-name2 {
  width: 100%;
  max-width: 100%;
}
.header-root-class-name3 {
  width: 100%;
  max-width: 100%;
}
.header-root-class-name4 {
  width: 100%;
  max-width: 100%;
}
@media(max-width: 991px) {
  .header-header {
    max-width: 1320px;
    margin-bottom: var(--dl-space-space-triplequarter);
  }
  .header-icon11 {
    margin-top: 0px;
    margin-bottom: 0px;
  }
  .header-icon13 {
    margin-top: 0px;
    margin-bottom: 0px;
  }
  .header-icon15 {
    margin-top: 0px;
    margin-bottom: 0px;
  }
}
@media(max-width: 767px) {
  .header-header {
    background-color: var(--dl-color-gray-white);
  }
  .header-burger-menu {
    display: flex;
  }
  .header-icon {
    fill: var(--dl-color-secondary-400);
  }
  .header-heading1 {
    color: var(--dl-color-secondary-400);
  }
  .header-container4, .header-container42 {
    display: none;
  }
  .header-container5 {
    display: none;
  }
  .header-container7 {
    display: none;
  }
  .header-root-class-name {
    margin-bottom: 0px;
  }
}
</style>
