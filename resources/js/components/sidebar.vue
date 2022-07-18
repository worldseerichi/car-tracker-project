<template>
  <div class="sidebar-container" v-if="this.$store.getters.getSidebarShown">
    <div class="sidebar-sidebar">
      <nav class="sidebar-title">
        <span class="sidebar-text"><span>VT Sidebar</span></span>
      </nav>
      <nav class="sidebar-filter-options" v-show="this.$route.fullPath == '/gps'">
        <span class="sidebar-location"><span>Location in format: Lat,Lng<br/>Ex: 39.7390615,-8.8170667</span></span>
        <input id="inputs"
          type="text"
          :placeholder="textinput_placeholder"
          v-model="filter.location"
          class="sidebar-location-input input"
        />
        <span class="sidebar-range"><span>Range (meters)</span></span>
        <input id="inputs"
          type="number"
          :placeholder="textinput_placeholder1"
          v-model="filter.range"
          class="sidebar-range-input input"
        />
        <span class="sidebar-start-date-time">Start Date and Time</span>
        <input id="inputs"
          type="datetime-local"
          v-model="filter.start_date"
          class="sidebar-start-date-time-input input"
        />
        <span class="sidebar-end-date-time">End Date and Time</span>
        <input id="inputs"
          type="datetime-local"
          v-model="filter.end_date"
          class="sidebar-end-date-time-input input"
        />

      </nav>
      <button class="sidebar-button button" @click="filterData()" v-show="this.$route.fullPath == '/gps'">Filter</button>
      <button class="sidebar-button button" @click="resetFilter()" v-show="this.$route.fullPath == '/gps'">Reset Filters</button>
      <button class="sidebar-button button" @click="exportFilters()" v-show="this.$route.fullPath == '/gps'">Export Filters</button>
      <nav class="sidebar-navigation">
        <span style="width: 100%;text-align: center" class="sidebar-text4 textSM ">Navigation links:</span>
        <router-link to="/gps" class="sidebar-navlink1">
          <div class="sidebar-container2">
            <svg viewBox="0 0 1024 1024" class="sidebar-icon2">
              <path
                d="M214 470h596l-64-192h-468zM746 682q26 0 45-19t19-45-19-45-45-19-45 19-19 45 19 45 45 19zM278 682q26 0 45-19t19-45-19-45-45-19-45 19-19 45 19 45 45 19zM808 256l88 256v342q0 18-12 30t-30 12h-44q-18 0-30-12t-12-30v-44h-512v44q0 18-12 30t-30 12h-44q-18 0-30-12t-12-30v-342l88-256q12-42 62-42h468q50 0 62 42z"
              ></path>
            </svg>
            <h1 class="sidebar-heading1" style="margin-top: 10px">{{ heading11 }}</h1>
          </div>
        </router-link>
        <router-link to="/manageAccounts" v-if="this.$store.getters.getAdminLogged">
            <div class="sidebar-container3">
                <svg viewBox="0 0 1024 1024" class="sidebar-icon4">
                    <path
                    d="M512 0c282.857 0 512 229.143 512 512 0 281.143-228 512-512 512-283.429 0-512-230.286-512-512 0-282.857 229.143-512 512-512zM865.714 772c53.143-73.143 85.143-162.857 85.143-260 0-241.714-197.143-438.857-438.857-438.857s-438.857 197.143-438.857 438.857c0 97.143 32 186.857 85.143 260 20.571-102.286 70.286-186.857 174.857-186.857 46.286 45.143 109.143 73.143 178.857 73.143s132.571-28 178.857-73.143c104.571 0 154.286 84.571 174.857 186.857zM731.429 402.286c0-121.143-98.286-219.429-219.429-219.429s-219.429 98.286-219.429 219.429 98.286 219.429 219.429 219.429 219.429-98.286 219.429-219.429z"
                    ></path>
                </svg>
                <h1 class="sidebar-heading2" style="margin-top: 10px">{{ heading11111 }}</h1>
            </div>
        </router-link>
        <div  v-if="this.$store.getters.getAdminLogged == false">
        <router-link to="/login">
            <div class="sidebar-container3" >
                <svg viewBox="0 0 1024 1024" class="sidebar-icon4">
                    <path
                    d="M512 0c282.857 0 512 229.143 512 512 0 281.143-228 512-512 512-283.429 0-512-230.286-512-512 0-282.857 229.143-512 512-512zM865.714 772c53.143-73.143 85.143-162.857 85.143-260 0-241.714-197.143-438.857-438.857-438.857s-438.857 197.143-438.857 438.857c0 97.143 32 186.857 85.143 260 20.571-102.286 70.286-186.857 174.857-186.857 46.286 45.143 109.143 73.143 178.857 73.143s132.571-28 178.857-73.143c104.571 0 154.286 84.571 174.857 186.857zM731.429 402.286c0-121.143-98.286-219.429-219.429-219.429s-219.429 98.286-219.429 219.429 98.286 219.429 219.429 219.429 219.429-98.286 219.429-219.429z"
                    ></path>
                </svg>
                <h1 class="sidebar-heading2" style="margin-top: 10px">{{ heading111 }}</h1>
            </div>
        </router-link>
        </div>
        <button  @click="signout()" style=" background-color: Transparent">
            <div class="sidebar-container3"  v-if="this.$store.getters.getAdminLogged">
                <svg viewBox="0 0 1024 1024" class="sidebar-icon4">
                    <path
                    d="M512 0c282.857 0 512 229.143 512 512 0 281.143-228 512-512 512-283.429 0-512-230.286-512-512 0-282.857 229.143-512 512-512zM865.714 772c53.143-73.143 85.143-162.857 85.143-260 0-241.714-197.143-438.857-438.857-438.857s-438.857 197.143-438.857 438.857c0 97.143 32 186.857 85.143 260 20.571-102.286 70.286-186.857 174.857-186.857 46.286 45.143 109.143 73.143 178.857 73.143s132.571-28 178.857-73.143c104.571 0 154.286 84.571 174.857 186.857zM731.429 402.286c0-121.143-98.286-219.429-219.429-219.429s-219.429 98.286-219.429 219.429 98.286 219.429 219.429 219.429 219.429-98.286 219.429-219.429z"
                    ></path>
                </svg>
                <h1 class="sidebar-heading2" style="margin-top: 10px">{{ heading1111 }}</h1>
            </div>
        </button>
      </nav>
      <nav class="sidebar-minimize" style="cursor: pointer;" @click="toggleSidebar()">
        <svg viewBox="0 0 1024 1024" class="sidebar-icon6">
          <path
            d="M854 470v84h-520l238 240-60 60-342-342 342-342 60 60-238 240h520z"
          ></path>
        </svg>
      </nav>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Sidebar',
  props: {
    textinput_placeholder: {
      type: String,
      default: 'enter some coordinates',
    },
    textinput_placeholder1: {
      type: String,
      default: 'enter a range',
    },
    heading1: {
      type: String,
      default: 'Homepage',
    },
    heading11: {
      type: String,
      default: 'Tracking',
    },
    heading111: {
      type: String,
      default: 'Login',
    },
    heading1111: {
      type: String,
      default: 'Logout',
    },
    heading11111: {
      type: String,
      default: 'Manage Users',
    },
  },
  data() {
    return {
      filter:{
        location: '',
        range: 300,
        start_date: null,
        end_date: null,
      },
      rawxe5q: ' ',
    }
  },
  methods: {
        toggleSidebar() {
            this.$store.commit('toggleSidebar');
        },
        signout(){
            this.$store.commit('storeLogout')
        },
        filterData() {
            this.$store.commit('filterData', this.filter);
        },
        resetFilter() {
            this.$store.commit('resetFilter');
            this.filter.location = '';
            this.filter.range = 300;
            this.resetDateInputs();
        },
        resetDateInputs(){
            var now = new Date();
            var yesterday = ( function(){this.setDate(this.getDate()-1); return this} ).call(new Date);
            //now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
            this.filter.start_date = yesterday.toISOString().slice(0, 16);
            this.filter.end_date = now.toISOString().slice(0, 16);
        },
        exportFilters(){
            this.downloadObjectAsJson({ location: this.filter.location ,range: this.filter.range, start_date: this.filter.start_date,end_date: this.filter.end_date} ,"FilterValues");
        },
        downloadObjectAsJson(exportObj, exportName){
            var dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(exportObj,null,4));
            var downloadAnchorNode = document.createElement('a');
            downloadAnchorNode.setAttribute("href",     dataStr);
            downloadAnchorNode.setAttribute("download", exportName + ".json");
            document.body.appendChild(downloadAnchorNode); // required for firefox
            downloadAnchorNode.click();
            downloadAnchorNode.remove();
        }
  },
  mounted() {
    this.resetDateInputs();
  }
}
</script>

<style scoped>
.sidebar-container {
  width: 250px;
  /*height: 100%;*/
  display: flex;
  flex: 1 1 auto;
  position: relative;
  align-items: flex-start;
  flex-direction: column;
}
.sidebar-sidebar {
  width: 100%;
  height: auto;
  display: flex;
  flex: 1 1 auto;
  position: relative;
  align-items: stretch;
  flex-direction: column;
  justify-content: flex-start;
  background-color: #303C54;
}
.sidebar-title {
  width: 100%;
  display: flex;
  align-items: center;
  flex-direction: column;
  justify-content: center;
  background-color: #111729;
}
.sidebar-text {
  color: #ffffff;
  align-self: stretch;
  font-style: normal;
  text-align: center;
  font-weight: 700;
  margin-bottom: 0px;
}
.sidebar-filter-options {
  display: flex;
  align-self: stretch;
  margin-top: var(--dl-space-space-triplequarter);
  align-items: stretch;
  flex-direction: column;
  justify-content: flex-start;
}
.sidebar-button {
  color: #ffffff;
  padding: 0px;
  align-self: stretch;
  margin-top: var(--dl-space-space-triplequarter);
  text-align: center;
  margin-left: var(--dl-space-space-tripleunit);
  border-color: #111729;
  border-width: 4px;
  margin-right: var(--dl-space-space-tripleunit);
  background-color: #303C54;
}
.sidebar-location {
  color: #ffffff;
  align-self: flex-start;
  margin-left: var(--dl-space-space-halfunit);
}
.sidebar-location-input {
  color: var(--dl-color-gray-black);
  background-color: var(--dl-color-pimary-800);
}
.sidebar-range {
  color: #ffffff;
  align-self: flex-start;
  margin-left: var(--dl-space-space-halfunit);
}
.sidebar-range-input {
  color: var(--dl-color-gray-black);
  background-color: var(--dl-color-pimary-800);
}
.sidebar-start-date-time {
  color: #ffffff;
  align-self: flex-start;
  margin-left: var(--dl-space-space-halfunit);
}
.sidebar-start-date-time-input {
  color: var(--dl-color-gray-black);
  background-color: var(--dl-color-pimary-800);
}
.sidebar-end-date-time {
  color: #ffffff;
  align-self: flex-start;
  margin-left: var(--dl-space-space-halfunit);
}
.sidebar-end-date-time-input {
  color: var(--dl-color-gray-black);
  background-color: var(--dl-color-pimary-800);
}
.sidebar-navigation {
  width: 100%;
  display: flex;
  align-self: stretch;
  margin-top: 10px;
  align-items: stretch;
  flex-direction: column;
  justify-content: center;
}
.sidebar-text4 {
  color: var(--dl-color-gray-white);
  align-self: stretch;
}
.sidebar-navlink {
  display: contents;
}
.sidebar-container1 {
  display: flex;
  align-self: center;
  margin-top: var(--dl-space-space-halfunit);
  align-items: center;
  margin-bottom: var(--dl-space-space-halfunit);
  flex-direction: row;
  justify-content: center;
  text-decoration: none;
}
.sidebar-icon {
  fill: #D9D9D9;
  width: 24px;
  height: 24px;
}
.sidebar-heading {
  color: var(--dl-color-gray-white);
  width: 121px;
  font-size: 0.87rem;
  align-self: center;
  text-align: center;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen","Ubuntu", "Cantarell", "Fira Sans","Droid Sans", "Helvetica Neue", sans-serif;
  font-weight: 400;
  line-height: 1.25;
  padding-top: var(--dl-space-space-halfunit);
  padding-bottom: var(--dl-space-space-halfunit);
}
.sidebar-navlink1 {
  display: contents;
}
.sidebar-container2 {
  display: flex;
  align-self: center;
  /*margin-top: var(--dl-space-space-halfunit);*/
  align-items: center;
  /*margin-bottom: var(--dl-space-space-halfunit);*/
  flex-direction: row;
  justify-content: center;
  text-decoration: none;
}
.sidebar-icon2 {
  fill: #D9D9D9;
  width: 24px;
  height: 24px;
}
.sidebar-heading1 {
  color: var(--dl-color-gray-white);
  width: 121px;
  font-size: 0.87rem;
  align-self: center;
  text-align: center;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen","Ubuntu", "Cantarell", "Fira Sans","Droid Sans", "Helvetica Neue", sans-serif;
  font-weight: 400;
  line-height: 1.25;
  padding-top: var(--dl-space-space-halfunit);
  padding-bottom: var(--dl-space-space-halfunit);
}
.sidebar-container3 {
  display: flex;
  align-self: center;
  /*margin-top: var(--dl-space-space-halfunit);*/
  align-items: center;
  /*margin-bottom: var(--dl-space-space-halfunit);*/
  flex-direction: row;
  justify-content: center;
}
.sidebar-icon4 {
  fill: var(--dl-color-gray-white);
  width: 24px;
  height: 24px;
}
.sidebar-heading2 {
  color: var(--dl-color-gray-white);
  width: 121px;
  font-size: 0.87rem;
  align-self: center;
  text-align: center;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen","Ubuntu", "Cantarell", "Fira Sans","Droid Sans", "Helvetica Neue", sans-serif;
  font-weight: 400;
  line-height: 1.25;
  padding-top: var(--dl-space-space-halfunit);
  padding-bottom: var(--dl-space-space-halfunit);
}
.sidebar-minimize {
  flex: 1;
  width: 100%;
  display: flex;
  align-self: stretch;
  margin-top: var(--dl-space-space-fiveunits);
  align-items: center;
  padding-top: var(--dl-space-space-halfunit);
  flex-direction: column;
  padding-bottom: var(--dl-space-space-halfunit);
  justify-content: center;
  background-color: #111729;
  bottom: 0;
  position: absolute;
}
.sidebar-icon6 {
  fill: var(--dl-color-gray-white);
  height: 24px;
  align-self: flex-end;
}
#inputs {
    width: 97%;
    margin: auto;
    padding: 0;
}
@media(max-width: 767px) {
  .sidebar-sidebar {
    height: 70vh;
  }
}
</style>
