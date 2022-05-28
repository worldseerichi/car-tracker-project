<template>
  <div class="login-container">
    <div class="login-image">
      <app-header></app-header>
      <img
        alt="image"
        src="../playground_assets/gray-vector.svg"
        class="login-image1"
      />
      <div class="login-bg"></div>
    </div>
    <form @submit.prevent="login()" class="login-container1">
      <div class="login-container2"><div class="login-container3"></div></div>
      <div class="login-container4">
        <span class="login-text">
          <span class="login-text01">Vehicle Tracker</span>
          <br />
          <span class="login-text03"><span v-html="rawxe5q"></span></span>
          <span class="login-text04">Login</span>
        </span>
        <label class="login-text05">Username</label>
        <input
          type="text"
          placeholder="username"
          id="username"
          name="username"
          v-model="user.username"
          required
          autofocus
          class="login-textinput input"
        />
        <label class="login-text06">Password</label>
        <input
          type="password"
          placeholder="password"
          id="password"
          name="password"
          v-model="user.password"
          required
          class="login-textinput1 input"
        />
        <button type="submit" class="login-button button">
          <span class="login-text07">
            <span>Login</span>
            <br />
            <span></span>
          </span>
        </button>
        <button class="login-button1 button">
          <span class="login-text11">
            <span>Recover Password</span>
            <br />
            <span></span>
          </span>
        </button>~
       <div>{{$store.getters.getKey}}</div>
      </div>
    </form>

  </div>
</template>

<script>
import AppHeader from '../components/header'
import axios from 'axios';

export default {
  name: 'Login',
  components: {
    AppHeader,
  },

  data() {
    return {
      user:{
        username: '',
        password: ''
      },
      rawxe5q: ' ',
      
    }
  },

  metaInfo: {
    title: 'Login - Car_Tracker_V1',
    meta: [
      {
        property: 'og:title',
        content: 'Login - Car_Tracker_V1',
      },
    ],
  },
  methods: {
      login(){
        this.$store.commit('storeLogin', this.user)
        console.log(this.$store.getters.getKey)
      }

     /*   login: function () {
            let self = this;
            axios.post('login-request', { username: this.username, password: this.password })
                .then(function (response) {
                    if(response.data == '/'){
                        self.$router.push('/')
                    }else if(response.data == 'login'){
                        self.$router.push('/login')
                        //implement some message about the failed login
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        }*/
      /*login(){
        let self = this;
        axios.get('/sanctum/csrf-cookie').then(response => {
          axios.post('login-request',this.formData).then(response => {
            if (response.data=='/'){
              //console.log(response);
              axios.get('loginCheck').then(response => {
                console.log(response)
              })
             // self.$router.push('/')
            }else{
              self.$router.push('login')
            }
          })
          .catch(function (error) {
                    console.log(error);
                });
          
        })
      }*/
  }
}
</script>

<style scoped>
.login-container {
  width: 100%;
  height: auto;
  display: flex;
  min-height: 100vh;
  align-items: center;
  flex-direction: column;
  justify-content: flex-start;
  background-color: #f2f5f9ff;
}
.login-image {
  width: 100%;
  height: 301px;
  display: flex;
  position: relative;
  align-items: center;
  flex-direction: column;
  background-size: cover;
  background-image: url('https://images.unsplash.com/photo-1499336315816-097655dcfbda?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1500&q=80');
}
.login-image1 {
  left: auto;
  right: auto;
  width: 100%;
  bottom: -1px;
  z-index: 100;
  position: absolute;
  object-fit: cover;
}
.login-bg {
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
.login-container1 {
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
.login-container2 {
  width: 100%;
  height: 35px;
  display: flex;
  align-items: center;
  flex-direction: column;
}
.login-container3 {
  flex: 0 0 auto;
  border: 2px dashed rgba(120, 120, 120, 0.4);
  display: flex;
  align-items: center;
  flex-direction: row;
  justify-content: center;
}
.login-container4 {
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
.login-text {
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
.login-text01 {
  font-style: normal;
  font-weight: 700;
}
.login-text03 {
  font-style: normal;
  font-weight: 700;
}
.login-text04 {
  font-style: normal;
  font-weight: 700;
}
.login-text05 {
  color: #000000;
  align-self: center;
  font-style: normal;
  margin-top: 1rem;
  font-weight: 700;
}
.login-textinput {
  width: 339px;
  align-self: center;
}
.login-text06 {
  color: #000000;
  align-self: center;
  font-style: normal;
  font-weight: 700;
}
.login-textinput1 {
  width: 339px;
  align-self: center;
  margin-bottom: 1rem;
}
.login-button {
  width: 80px;
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
.login-text07 {
  color: #000000;
  font-style: normal;
  font-weight: 700;
  padding-top: var(--dl-space-space-halfunit);
  padding-bottom: var(--dl-space-space-halfunit);
}
.login-button1 {
  width: 179px;
  height: 62px;
  align-self: center;
  padding-top: var(--dl-space-space-halfunit);
  padding-left: var(--dl-space-space-unit);
  margin-bottom: var(--dl-space-space-doubleunit);
  padding-right: var(--dl-space-space-unit);
  padding-bottom: var(--dl-space-space-halfunit);
  background-color: #e85454;
}
.login-text11 {
  color: #000000;
  font-style: normal;
  font-weight: 700;
}
</style>
