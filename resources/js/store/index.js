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
import createPersistedState from 'vuex-persistedstate'

export default createStore({
    plugins: [createPersistedState({
        storage: window.sessionStorage,
        paths: ['sidebarShown', 'adminLogged'] // save these states in session storage
    })],
    state:{
        user: {},
        key: "",
        randomBoolean: false,
        adminLogged: false,
        sidebarShown: false,
        filtered: false,
        filter: {
            location: '',
            range: 300,
            start_date: null,
            end_date: null,
        }
    },
    mutations:{
       async storeLogin(state,payload){
            //console.log("storeLogin");
            axios.get('/sanctum/csrf-cookie').then(response => {
                //console.log(response);
                axios.post('api/login-request',payload.user).then(response => {
                    if (response.data=='/'){
                        //console.log(response)
                        console.log("login success");
                        //state.key = response.data.access_token
                        state.adminLogged = true;

                        payload.self.$router.push('/')
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
            axios.post('api/signout').then(response => {
                state.adminLogged = false;
                console.log("signed out");
            }).catch(function (error) {
                          console.log(error);
            });
        },
        async toggleSidebar(state,payload){
            state.sidebarShown = !state.sidebarShown;
        },
        async toggleRandomBoolean(state,payload){
            state.randomBoolean = !state.randomBoolean;
        },
        async filterData(state,payload){
            state.filtered = true;
            state.filter.location = payload.location;
            state.filter.range = payload.range;
            state.filter.start_date = payload.start_date;
            state.filter.end_date = payload.end_date;
        },
        async resetFilter(state,payload){
            state.filtered = false;
            state.filter.location = '';
            state.filter.range = 300;
            state.filter.start_date = null;
            state.filter.end_date = null;
        }

    },
    actions:{},
    getters:{
        getkey(state){
            return state.key
        },
        getAdminLogged(state){
            return state.adminLogged
        },
        getSidebarShown(state){
            return state.sidebarShown
        },
        getFilter(state){
            return state.filter
        },
        getStartDate(state){
            return state.filter.start_date
        },
        getEndDate(state){
            return state.filter.end_date
        },
        getLocation(state){
            return state.filter.location
        },
        isFiltered(state){
            return state.filtered
        },
        getRange(state){
            return state.filter.range
        }
    },
    modules:{},
})
