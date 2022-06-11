/*
import * as Vue from "vue"
import * as Vuex from "vuex"
import * as currentUser from "./modules/currentUser"


export default new Vuex.Store({
    modules:{
        currentUser : currentUser
    }
})*/

import {createStore } from 'vuex'
import axios from 'axios'

export default createStore({
    state:{
        user: {},
        key: ""
    },
    mutations:{
       async storeLogin(state,payload){
            console.log("nani");
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('login-request',payload).then(response => {
                    if (response.data=='/'){
                    console.log(response.data)
                    console.log(response)
                    state.key = response.data.access_token

                   // self.$router.push('/')
                  }else{
                   // self.$router.push('login')
                  }
                })
                .catch(function (error) {
                          console.log(error);
                      });

              })
        }

    },
    actions:{},
    getters:{
        getkey(state){
            return state.key
        }
    },
    modules:{},
})
