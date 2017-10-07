import VueRouter from 'vue-router';

let routes = [
  { 
    path: '/', 
    component: require('./components/Example.vue') 
  }
];

export default new VueRouter({
  routes
});