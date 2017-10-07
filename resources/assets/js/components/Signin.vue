<template>
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">Signin</div>
          <div class="panel-body">
            <div class="alert alert-danger" v-if="error">
              <p>There was an error, unable to sign in with those credentials.</p>
            </div>
            <form autocomplete="off" v-on:submit="signin" class="form-horizontal">
              <div class="form-group">
                <label for="email" class="col-md-4 control-label">E-mail</label>
                <div class="col-md-6">
                  <input type="email" id="email" class="form-control" v-model="email" required>
                </div>
              </div>
              <div class="form-group">
                <label for="password" class="col-md-4 control-label">Password</label>
                <div class="col-md-6">
                  <input type="password" id="password" class="form-control" v-model="password" required>  
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-5 col-md-offset-4">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="remember"> Remember Me
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                  <button type="submit" class="btn btn-primary">Sign In</button>
                  <span style="margin-left:30px"><a href="#">Forgot Your Password?</a></span>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import auth from '../auth.js';

export default {
  data() {
    return {
      email: null,
      password: null,
      error: false
    }
  },
  methods: {
    signin(event) {
      event.preventDefault()
      auth.signin(this, this.email, this.password)
    }
  }
}
</script>
