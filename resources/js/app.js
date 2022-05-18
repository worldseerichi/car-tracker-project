import * as Vue from 'vue'
import * as VueRouter from 'vue-router'
import * as Meta from 'vue-meta'

//Vue.use(VueRouter)

import GPS from './views/g-p-s'
import Home from './views/Home'
import App from './views/App'
import './style.css'

const router = VueRouter.createRouter({
    history: VueRouter.createWebHistory(),
    routes: [
        {
          name: 'GPS',
          path: '/g-p-s',
          component: GPS,
        },
        {
          name: 'Home',
          path: '/',
          component: Home,
        },
      ],
  });

Vue.createApp(App).use(router).use(Meta).mount('#app');
