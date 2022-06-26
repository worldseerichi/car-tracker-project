import * as Vue from 'vue'
import * as Vuex from "vuex"
import * as VueRouter from 'vue-router'
import * as Meta from 'vue-meta'


import { createApp } from 'vue'
import { createStore } from 'vuex'
//Vue.use(VueRouter)


import GPS from './views/g-p-s'
import Home from './views/Home'
import App from './views/App'
import Login from './views/login'
import RegisterAccounts from './views/register-accounts'
import auth from './middleware/auth'
import './style.css'
import store from "./store"

window.Vue = require('vue').default;
const router = VueRouter.createRouter({
    history: VueRouter.createWebHistory(),
    //store,
    routes: [
        {
            name: 'GPS',
            path: '/g-p-s',
            component: GPS,
            meta: {
                middleware: auth,
            },
        },
        {
            name: 'Home',
            path: '/',
            component: Home,
        },
        {
            name: 'Login',
            path: '/login',
            component: Login,
        },
        {
            name: 'RegisterAccounts',
            path: '/register-accounts',
            component: RegisterAccounts,
        },
      ],
  });

function nextFactory(context, middleware, index) {
    const subsequentMiddleware = middleware[index];
    // If no subsequent Middleware exists,
    // the default `next()` callback is returned.
    if (!subsequentMiddleware) return context.next;

    return (...parameters) => {
        // Run the default Vue Router `next()` callback first.
        context.next(...parameters);
        // Then run the subsequent Middleware with a new
        // `nextMiddleware()` callback.
        const nextMiddleware = nextFactory(context, middleware, index + 1);
        subsequentMiddleware({ ...context, next: nextMiddleware });
    };
}

router.beforeEach((to, from, next) => {
    if (to.meta.middleware) {
        const middleware = Array.isArray(to.meta.middleware)
            ? to.meta.middleware
            : [to.meta.middleware];

        const context = {
            from,
            next,
            router,
            to,
        };
        const nextMiddleware = nextFactory(context, middleware, 1);

        return middleware[0]({ ...context, next: nextMiddleware });
    }

    return next();
});
const app = createApp(App)
app.use(router)
app.use(Meta)
app.use(Vuex)
app.use(store)
app.mount('#app');
