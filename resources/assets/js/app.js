import router from './routes.js';
import auth from './auth.js';

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';
Vue.use(VueRouter);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 router.beforeEach((to, from, next) => {
  if (to.matched.some(x => x.meta.requiresAuth)) {
    auth.check();
    if(!auth.user.authenticated) {
      next({ path: '/signin', query: { redirect: to.fullPath } });
    }
  }
  next();
});

Vue.component('App', require('./components/App.vue'));

const app = new Vue({
    el: '#app',
    router
});
