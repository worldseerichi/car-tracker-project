<template>
  <div class="g-p-s1-container">
    <div class="g-p-s1-image">
      <app-header rootClassName="header-root-class-name5"></app-header>
    </div>
    <div class="g-p-s1-container1">
      <span class="g-p-s1-text">User Managment</span>
      <button @click="this.getTableData" class="g-p-s1-button button">
        <span class="g-p-s1-text01">
          <span class="g-p-s1-text02">Refresh</span>
          <br />
          <span></span>
        </span>
      </button>

    </div>
    <div class="g-p-s1-container2" style="overflow:scroll;height:300px;width:100%;overflow:auto">

      <table class="table table-bordered align-middle">
          <thead>
            <tr >
              <th scope="col">User ID</th>
              <th scope="col">Username</th>
              <th scope="col">Quantity Of Tracking Data</th>
              <th scope="col">Number of Devices</th>
              <th scope="col">Created At</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(s,index) in s" :key="index">
               <th>{{s[0]}}</th>
               <th>{{s[1][4][0]}}</th>
               <th v-if="s[1][1]!= null">{{s[1][1]}}</th><th v-else>0</th>
               <th v-if="s[1][2]!= null">{{s[1][2]}}</th><th v-else>0</th>
               <th>{{s[1][0][0].substring(0,s[1][0][0].indexOf('T'))}}</th>
               <th v-if="s[1][3][0]==null"><button type="button" @click="this.softDelete(s[0])" class="btn btn-link btn-sm px-3" data-ripple-color="dark">
                  Delete
                </button></th><th v-else><button type="button" @click="this.restore(s[0])" class="btn btn-link btn-sm px-3" data-ripple-color="dark">
                  Restore
                </button></th>
              <!--@click="update(data)"  + data.index-->
            </tr>
          </tbody>
      </table>

    </div>
    <form @submit.prevent="register()">
    <div class="g-p-s1-container3">
      <span class="g-p-s1-text01">Create new User</span>
      <div class="g-p-s1-container4">
        <label class="g-p-s1-text02">
          <span>
            Username :
            <span v-html="raw04vt"></span>
          </span>

        </label>
        <input
          type="text"
          placeholder="username"
          id="username"
          name="username"
          v-model="username"
          required
          autofocus
          class="g-p-s1-textinput input"
        />
      </div>
      <div class="g-p-s1-container5">
        <label class="g-p-s1-text04">
          <span>
            Password :
            <span v-html="rawa29k"></span>
          </span>
        </label>
        <input
          type="password"
          placeholder="password"
          id="password"
          name="password"
          v-model="password"
          required
          class="g-p-s1-textinput1 input"
        />
      </div>
      <button type="submit" class="g-p-s1-button2 button">
        <span class="g-p-s1-text06">
          <span class="g-p-s1-text07" style="text-transform: none;">Create Account</span>
          <br />
          <span></span>
        </span>
      </button>
    </div>
    </form>
  </div>

</template>

<script>
import AppHeader from '../components/header'
import "bootstrap/dist/js/bootstrap.js";
import "bootstrap/dist/css/bootstrap.min.css";
import axios from 'axios';
import { useToast } from 'vue-toastification';

var toastId = null;

export default {
  name: 'GPS1',
  components: {
    AppHeader,
  },

  data : function() {
    return {
      raw04vt: ' ',
      rawa29k: ' ',
      accounts:[],
      positions:[],
      s:[],
      username: '',
      password: '',

      fields:['#','Quantity Of API Requests','Created At','Actions'],
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
  methods:{
     getTableData: function(){
        toastId = this.toast.info("Loading data...", { timeout: false });
        axios.get('api/getDataCounted').then(response => {
            //console.log(response);
            if(response.data == 'No data found'){
                this.toast.update(toastId, { content: response.data, options: { timeout: 5000, type: "error" } }, true);
            }else{
                  var uniqueUserIdArray;
                  var userDataMap = new Map();
                  var userDeviceMap = new Map();
                  var deviceAmount = new Map();
                  uniqueUserIdArray = [...new Set(response.data["users"].map(item => item.id))];

                  uniqueUserIdArray.forEach(function(userId) {
                    userDeviceMap.set(
                        userId,
                        response.data["devices"].filter(data => data.user_id == userId)
                        .map(function (data) { return data.id; })
                        )
                      });
                  const object = response.data['requestamounts'][0]

                  for (const property in object) {deviceAmount.set(property,object[property])}

                uniqueUserIdArray.forEach(function(userId) {
                    const first = [...userDeviceMap.get(userId)]
                    var amount = 0;
                    deviceAmount.forEach(function(value,key){
                        if(first.includes(parseInt(key))){
                            amount += value;
                        }
                    })

                    userDataMap.set(
                        userId,
                            [
                            response.data["users"].filter(data => data.id == userId)
                            .map(function (data) { return data.created_at; }),
                            amount,
                            userDeviceMap.get(userId).length,
                            response.data["users"].filter(data => data.id == userId)
                            .map(function (data) { return data.deleted_at; }),
                            response.data["users"].filter(data => data.id == userId)
                            .map(function (data) { return data.username; })

                        ])
                  });
                this.s = Array.from(userDataMap)
                this.toast.update(toastId, { content: "Data loaded.", options: { timeout: 5000, type: "success" } }, true);
                }
      })
        .catch(e => {
            this.toast.update(toastId, { content: "Something went wrong...", options: { timeout: 3000, type: "error" } }, true);
            console.log("getTableData failed due to: " + e);
        });

    },
    register: function () {
            var self = this;
            this.toast.info("Registering account...", { id:"register", timeout: false });
            axios.post('api/registration-request', { username: this.username, password: this.password })
                .then(function (response) {
                    //console.log(response);
                    self.toast.update("register", { content: response.data, options: { timeout: 5000, type: "success" } }, true);
                    self.getTableData();
                })
                .catch(function (error) {
                    console.log(error);
                    self.toast.update("register", { content: "Something went wrong...", options: { timeout: 3000, type: "error" } }, true);
                });

        },
    softDelete(userId){
      var self = this;
      this.toast.info("Deleting account...", { id:"delete", timeout: false });
      axios.delete('api/users/'+userId)
                .then(function (response) {
                    //console.log(response);
                    self.toast.update("delete", { content: response.data, options: { timeout: 5000, type: "success" } }, true);
                    self.getTableData();
                })
                .catch(function (error) {
                    console.log(error);
                    self.toast.update("delete", { content: "Something went wrong...", options: { timeout: 3000, type: "error" } }, true);
                });

    },
    restore(userId){
      var self = this;
      this.toast.info("Restoring account...", { id:"restore", timeout: false });
      axios.get('api/users/restore/'+userId)
                .then(function (response) {
                    //console.log(response);
                    self.toast.update("restore", { content: response.data, options: { timeout: 5000, type: "success" } }, true);
                    self.getTableData();
                })
                .catch(function (error) {
                    console.log(error);
                    self.toast.update("restore", { content: "Something went wrong...", options: { timeout: 3000, type: "error" } }, true);
                });


    }
  },
    mounted(){
        this.getTableData();
    },
    setup(){
        const toast = useToast();

        return { toast };
    },
    watch: {
        '$store.state.adminLogged': {
            handler() {
                if (this.$store.getters.getAdminLogged == false) {
                    this.$router.push('/login');
                };
            }
        },
    }
}
</script>
<style scoped>
.g-p-s1-button2 {
  width: 201px;
  height: 45px;
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
  align-items: center;
  flex-direction: column;
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
.g-p-s1-button {
  width: 72px;
  height: 39px;
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
.g-p-s1-text01 {
  color: #000000;
  font-size: 0.9rem;
  align-self: center;
  font-style: normal;
  font-weight: 700;
  padding-top: 0.3rem;
  padding-left: 1.3rem;
  padding-right: 1.3rem;
  padding-bottom: 0.3rem;
}
.g-p-s1-text02 {
  font-style: normal;
  font-weight: 400;
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
.g-p-s1-text05 {
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
  margin-top: 15px;
  align-items: flex-start;
  margin-bottom: 5px;
  justify-content: flex-start;
}
.g-p-s1-text06 {
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
  padding-bottom: 25px;
  justify-content: center;
}
.g-p-s1-text08 {
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
.g-p-s1-button1 {
  width: 201px;
  height: 45px;
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
.g-p-s1-text10 {
  color: #000000;
  font-size: 0.9rem;
  align-self: stretch;
  font-style: normal;
  font-weight: 700;
  padding-top: 0.3rem;
  padding-left: 1.3rem;
  padding-right: 1.3rem;
  padding-bottom: 0.3rem;
}
.g-p-s1-text11 {
  font-style: normal;
  font-weight: 400;
}
</style>
