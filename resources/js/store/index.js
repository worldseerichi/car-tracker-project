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
import { useToast } from 'vue-toastification'

const toast = useToast()

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
        filter: {
            location: '39.7390615,-8.8170667',
            range: 500,
            start_date: null,
            end_date: null,
            randomFilterBoolean: false,
        }
    },
    mutations:{
       async storeLogin(state,payload){
            //console.log("storeLogin");
            toast.info("Logging in...", { id: "login", timeout: false });
            axios.get('/sanctum/csrf-cookie').then(response => {
                //console.log(response);
                axios.post('api/login-request',payload.user).then(response => {
                    if (response.data=='/'){
                        //console.log(response)
                        //console.log("login success");
                        toast.update("login", { content: "Login successful.", options: { timeout: 3000, type: "success" } });
                        //state.key = response.data.access_token
                        state.adminLogged = true;

                        payload.self.$router.push('/')
                    }else{
                        // self.$router.push('login')
                        //console.log("login failed");
                        toast.update("login", { content: "Login failed.", options: { timeout: 3000, type: "error" } });
                    }
                })
                .catch(function (error) {
                    toast.update("login", { content: "Something went wrong...", options: { timeout: 3000, type: "error" } });
                    console.log(error);
                });

            })
        },
        async storeLogout(state,payload){
            toast.info("Signing out...", { id: "signout", timeout: false });
            axios.post('api/signout').then(response => {
                state.adminLogged = false;
                //console.log("signed out");
                toast.update("signout", { content: "Signout successful.", options: { timeout: 3000, type: "success" } });
            }).catch(function (error) {
                toast.update("signout", { content: "Something went wrong...", options: { timeout: 3000, type: "error" } });
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
            state.filter.location = payload.location;
            state.filter.range = payload.range;
            state.filter.start_date = payload.start_date;
            state.filter.end_date = payload.end_date;
            state.filter.randomFilterBoolean = !state.filter.randomFilterBoolean;
        },
        async resetFilter(state,payload){
            state.filter.location = '39.7390615,-8.8170667';
            state.filter.range = 500;
            var now = new Date();
            var yesterday = ( function(){this.setDate(this.getDate()-1); return this} ).call(new Date);
            state.filter.start_date = yesterday.toISOString().slice(0, 16);
            state.filter.end_date = now.toISOString().slice(0, 16);
            state.filter.randomFilterBoolean = !state.filter.randomFilterBoolean;
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
        getRange(state){
            return state.filter.range
        }
    },
    modules:{},
})
