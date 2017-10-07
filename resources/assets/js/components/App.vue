<template>
  <div>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Simple Image Gallery</a>
        </div>
        <ul class="nav navbar-nav">
          <li v-if="auth.user.authenticated"><router-link to="/">Home</router-link></li>
          <li v-if="auth.user.authenticated"><router-link to="/gallery">Gallery</router-link></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li v-if="!auth.user.authenticated"><router-link to="/signin">Login</router-link></li>
          <li v-if="!auth.user.authenticated"><router-link to="/register">Register</router-link></li>
          <li class="dropdown" v-if="auth.user.authenticated">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
              {{ auth.user.profile.name }} <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#" v-on:click="signout"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
    <router-view></router-view>
  </div>
</template>

<script>
import auth from '../auth.js';

export default {
  data() {
    return {
      auth: auth
    }
  },
  methods: {
    signout() {
      auth.signout()
    }
  },
  mounted: function () {
    this.$nextTick(function () {
      auth.check()
    });
  }
}
</script>