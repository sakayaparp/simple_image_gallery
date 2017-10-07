import router from './routes.js';
import axios from 'axios';

export default {
  user: {
    authenticated: false,
    profile: null
  },
  check() {
    let token = localStorage.getItem('id_token')
    if (token !== null) {
      return new Promise((resolve, reject) => {
        axios.get('api/user?token=' + token).then(response => {
          this.user.authenticated = true
          this.user.profile = response.data.data
          resolve(response.data.data);
        });
      });
    }
  },
  register(context, name, email, password, passwordConfirm) {
    axios.post('api/register', {
      name: name,
      email: email,
      password: password,
      passwordConfirm: passwordConfirm,
    }).then(response => {
      context.success = true
      this.signin(context, email, password);
    }).catch(error => {
      context.response = error.response.data
      context.error = true
    });
  },
  signin(context, email, password) {
    axios.post('api/signin', {
        email: email,
        password: password
    }).then(response => {
      context.error = false
      localStorage.setItem('email', email)
      localStorage.setItem('id_token', response.data.meta.token)
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('id_token');

      this.user.authenticated = true
      this.user.profile = response.data.data

      router.push({
        path: '/'
      });
    }, response => {
        context.error = true
    });
  },
  signout() {
    localStorage.removeItem('id_token');
    localStorage.removeItem('email');
    this.user.authenticated = false
    this.user.profile = null

    router.push({
      name: 'signin'
    });
  }
}