<template>
  <div data-role="Header" class="header-header" v-bind:class="rootClassName">
    <div data-type="BurgerMenu" class="header-burger-menu">
      <svg viewBox="0 0 1024 1024" class="header-icon">
        <path
          d="M128 256h768v86h-768v-86zM128 554v-84h768v84h-768zM128 768v-86h768v86h-768z"
        ></path>
      </svg>
    </div>
    <div data-type="MobileMenu" class="header-mobile-menu">
      <div class="header-top">
        <router-link to="/" class="header-navlink">
          <h1 class="header-heading textSM">{{ heading1 }}</h1>
        </router-link>
        <div data-type="CloseMobileMenu" class="header-close-menu">
          <svg viewBox="0 0 1024 1024" class="header-icon02">
            <path
              d="M810 274l-238 238 238 238-60 60-238-238-238 238-60-60 238-238-238-238 60-60 238 238 238-238z"
            ></path>
          </svg>
        </div>
      </div>
      <div class="header-mid">
        <router-link to="/g-p-s" class="header-navlink1">
          <div class="header-container">
            <svg viewBox="0 0 1024 1024" class="header-icon04">
              <path
                d="M576 706.612v-52.78c70.498-39.728 128-138.772 128-237.832 0-159.058 0-288-192-288s-192 128.942-192 288c0 99.060 57.502 198.104 128 237.832v52.78c-217.102 17.748-384 124.42-384 253.388h896c0-128.968-166.898-235.64-384-253.388z"
              ></path>
            </svg>
            <span class="header-text textSM">Tracking</span>
          </div>
        </router-link>
        <div class="header-container1">
          <svg viewBox="0 0 1024 1024" class="header-icon06">
            <path
              d="M917.806 229.076c-22.212-30.292-53.174-65.7-87.178-99.704s-69.412-64.964-99.704-87.178c-51.574-37.82-76.592-42.194-90.924-42.194h-496c-44.112 0-80 35.888-80 80v864c0 44.112 35.888 80 80 80h736c44.112 0 80-35.888 80-80v-624c0-14.332-4.372-39.35-42.194-90.924zM785.374 174.626c30.7 30.7 54.8 58.398 72.58 81.374h-153.954v-153.946c22.984 17.78 50.678 41.878 81.374 72.572zM896 944c0 8.672-7.328 16-16 16h-736c-8.672 0-16-7.328-16-16v-864c0-8.672 7.328-16 16-16 0 0 495.956-0.002 496 0v224c0 17.672 14.326 32 32 32h224v624z"
            ></path>
            <path
              d="M736 832h-448c-17.672 0-32-14.326-32-32s14.328-32 32-32h448c17.674 0 32 14.326 32 32s-14.326 32-32 32z"
            ></path>
            <path
              d="M736 704h-448c-17.672 0-32-14.326-32-32s14.328-32 32-32h448c17.674 0 32 14.326 32 32s-14.326 32-32 32z"
            ></path>
            <path
              d="M736 576h-448c-17.672 0-32-14.326-32-32s14.328-32 32-32h448c17.674 0 32 14.326 32 32s-14.326 32-32 32z"
            ></path>
          </svg>
          <span class="header-text1 textSM">BLOG</span>
        </div>
      </div>
      <div class="header-bot">
        <svg viewBox="0 0 877.7142857142857 1024" class="header-icon11">
          <path
            d="M713.143 73.143c90.857 0 164.571 73.714 164.571 164.571v548.571c0 90.857-73.714 164.571-164.571 164.571h-107.429v-340h113.714l17.143-132.571h-130.857v-84.571c0-38.286 10.286-64 65.714-64l69.714-0.571v-118.286c-12-1.714-53.714-5.143-101.714-5.143-101.143 0-170.857 61.714-170.857 174.857v97.714h-114.286v132.571h114.286v340h-304c-90.857 0-164.571-73.714-164.571-164.571v-548.571c0-90.857 73.714-164.571 164.571-164.571h548.571z"
          ></path></svg
        ><svg viewBox="0 0 1024 1024" class="header-icon13">
          <path
            d="M1024 226.4c-37.6 16.8-78.2 28-120.6 33 43.4-26 76.6-67.2 92.4-116.2-40.6 24-85.6 41.6-133.4 51-38.4-40.8-93-66.2-153.4-66.2-116 0-210 94-210 210 0 16.4 1.8 32.4 5.4 47.8-174.6-8.8-329.4-92.4-433-219.6-18 31-28.4 67.2-28.4 105.6 0 72.8 37 137.2 93.4 174.8-34.4-1-66.8-10.6-95.2-26.2 0 0.8 0 1.8 0 2.6 0 101.8 72.4 186.8 168.6 206-17.6 4.8-36.2 7.4-55.4 7.4-13.6 0-26.6-1.4-39.6-3.8 26.8 83.4 104.4 144.2 196.2 146-72 56.4-162.4 90-261 90-17 0-33.6-1-50.2-3 93.2 59.8 203.6 94.4 322.2 94.4 386.4 0 597.8-320.2 597.8-597.8 0-9.2-0.2-18.2-0.6-27.2 41-29.4 76.6-66.4 104.8-108.6z"
          ></path></svg
        ><svg viewBox="0 0 877.7142857142857 1024" class="header-icon15">
          <path
            d="M438.857 73.143c242.286 0 438.857 196.571 438.857 438.857 0 193.714-125.714 358.286-300 416.571-22.286 4-30.286-9.714-30.286-21.143 0-14.286 0.571-61.714 0.571-120.571 0-41.143-13.714-67.429-29.714-81.143 97.714-10.857 200.571-48 200.571-216.571 0-48-17.143-86.857-45.143-117.714 4.571-11.429 19.429-56-4.571-116.571-36.571-11.429-120.571 45.143-120.571 45.143-34.857-9.714-72.571-14.857-109.714-14.857s-74.857 5.143-109.714 14.857c0 0-84-56.571-120.571-45.143-24 60.571-9.143 105.143-4.571 116.571-28 30.857-45.143 69.714-45.143 117.714 0 168 102.286 205.714 200 216.571-12.571 11.429-24 30.857-28 58.857-25.143 11.429-89.143 30.857-127.429-36.571-24-41.714-67.429-45.143-67.429-45.143-42.857-0.571-2.857 26.857-2.857 26.857 28.571 13.143 48.571 64 48.571 64 25.714 78.286 148 52 148 52 0 36.571 0.571 70.857 0.571 81.714 0 11.429-8 25.143-30.286 21.143-174.286-58.286-300-222.857-300-416.571 0-242.286 196.571-438.857 438.857-438.857zM166.286 703.429c1.143-2.286-0.571-5.143-4-6.857-3.429-1.143-6.286-0.571-7.429 1.143-1.143 2.286 0.571 5.143 4 6.857 2.857 1.714 6.286 1.143 7.429-1.143zM184 722.857c2.286-1.714 1.714-5.714-1.143-9.143-2.857-2.857-6.857-4-9.143-1.714-2.286 1.714-1.714 5.714 1.143 9.143 2.857 2.857 6.857 4 9.143 1.714zM201.143 748.571c2.857-2.286 2.857-6.857 0-10.857-2.286-4-6.857-5.714-9.714-3.429-2.857 1.714-2.857 6.286 0 10.286s7.429 5.714 9.714 4zM225.143 772.571c2.286-2.286 1.143-7.429-2.286-10.857-4-4-9.143-4.571-11.429-1.714-2.857 2.286-1.714 7.429 2.286 10.857 4 4 9.143 4.571 11.429 1.714zM257.714 786.857c1.143-3.429-2.286-7.429-7.429-9.143-4.571-1.143-9.714 0.571-10.857 4s2.286 7.429 7.429 8.571c4.571 1.714 9.714 0 10.857-3.429zM293.714 789.714c0-4-4.571-6.857-9.714-6.286-5.143 0-9.143 2.857-9.143 6.286 0 4 4 6.857 9.714 6.286 5.143 0 9.143-2.857 9.143-6.286zM326.857 784c-0.571-3.429-5.143-5.714-10.286-5.143-5.143 1.143-8.571 4.571-8 8.571 0.571 3.429 5.143 5.714 10.286 4.571s8.571-4.571 8-8z"
          ></path>
        </svg>
      </div>
    </div>
    <div class="header-container2"></div>
    <div class="header-container3">
        <div class="header-container4" style="cursor: pointer;" @click="toggleSidebar()">
            <svg viewBox="0 0 1024 1024" class="header-icon17">
                <path
                    d="M64 192h896v192h-896zM64 448h896v192h-896zM64 704h896v192h-896z"
                ></path>
            </svg>
        </div>
      <router-link to="/" class="header-navlink2">
        <h1 class="header-heading1 textSM">{{ heading1 }}</h1>
      </router-link>
      <router-link to="/g-p-s" class="header-navlink3">
        <div class="header-container4">
          <svg viewBox="0 0 1024 1024" class="header-icon17">
            <path
              d="M214 470h596l-64-192h-468zM746 682q26 0 45-19t19-45-19-45-45-19-45 19-19 45 19 45 45 19zM278 682q26 0 45-19t19-45-19-45-45-19-45 19-19 45 19 45 45 19zM808 256l88 256v342q0 18-12 30t-30 12h-44q-18 0-30-12t-12-30v-44h-512v44q0 18-12 30t-30 12h-44q-18 0-30-12t-12-30v-342l88-256q12-42 62-42h468q50 0 62 42z"
            ></path>
          </svg>
          <span class="header-text2 textSM">Tracking</span>
        </div>
      </router-link>
      <router-link to="/register-accounts" class="header-navlink4" v-if="this.$store.getters.getAdminLogged">
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
.header-container4 {
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
.header-container4 {
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
  .header-container4 {
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
