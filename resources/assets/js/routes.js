import VueRouter from 'vue-router';

let routes = [
  { 
    path: '/', 
    name: 'home',
    component: require('./components/Home'),
    meta: { requiresAuth: true } 
  },
  { 
    path: '/signin', 
    name: 'signin',
    component: require('./components/Signin') 
  },
  { 
    path: '/register', 
    component: require('./components/Register') 
  },
  { 
    path: '/gallery', 
    component: require('./components/Gallery'),
    meta: { requiresAuth: true } 
  }
];

export default new VueRouter({
  routes
});