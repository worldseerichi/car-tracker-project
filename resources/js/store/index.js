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
        key: "",
        adminLogged: false,
    },
    mutations:{
       async storeLogin(state,payload){
            //console.log("storeLogin");
            axios.get('/sanctum/csrf-cookie').then(response => {
                console.log(response);
                axios.post('login-request',payload).then(response => {
                    if (response.data=='/'){
                        //console.log(response)
                        console.log("login success");
                        //state.key = response.data.access_token
                        state.adminLogged = true;

                        // self.$router.push('/')
                    }else{
                        // self.$router.push('login')
                        console.log("login failed");
                    }
                })
                .catch(function (error) {
                          console.log(error);
                      });

              })
        },
        async storeLogout(state,payload){
            axios.post('signout').then(response => {
                state.adminLogged = false;
                console.log("signed out");
            }).catch(function (error) {
                          console.log(error);
            });
        },

    },
    actions:{},
    getters:{
        getkey(state){
            return state.key
        },
        getAdminLogged(state){
            return state.adminLogged
        }
    },
    modules:{},
})
