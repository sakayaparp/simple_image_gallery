<template>
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">Register</div>
          <div class="panel-body">
            <div>
              <div class="alert alert-danger" v-if="error && !success">
                  <p>There was an error, unable to complete registration.</p>
              </div>
              <div class="alert alert-success" v-if="success">
                  <p>Registration completed. You can now sign in.</p>
              </div>
              <form autocomplete="off" v-on:submit="register" v-if="!success" class="form-horizontal">
                <div class="form-group" v-bind:class="{ 'has-error': error && response.name }">
                  <label for="name" class="col-md-4 control-label">Name</label>
                  <div class="col-md-6">
                    <input type="text" id="name" class="form-control" v-model="name" required>
                    <span class="help-block" v-if="error && response.name">{{ response.name[0] }}</span>
                  </div>
                </div>
                <div class="form-group" v-bind:class="{ 'has-error': error && response.email }">
                  <label for="email" class="col-md-4 control-label">Email</label>
                  <div class="col-md-6">
                    <input type="email" id="email" class="form-control" v-model="email" required>
                    <span class="help-block" v-if="error && response.email">{{ response.email[0] }}</span>
                  </div>
                </div>
                <div class="form-group" v-bind:class="{ 'has-error': error && response.password }">
                  <label for="password" class="col-md-4 control-label">Password</label>
                  <div class="col-md-6">
                    <input type="password" id="password" class="form-control" v-model="password" required>
                    <span class="help-block" v-if="error && response.password">{{ response.password[0] }}</span>
                  </div>
                </div>
                <div class="form-group" v-bind:class="{ 'has-error': error && response.passwordConfirm }">
                  <label for="passwordConfirm" class="col-md-4 control-label">Confirm Password</label>
                  <div class="col-md-6">
                    <input type="password" id="passwordConfirm" class="form-control" v-model="passwordConfirm" required>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">Register</button>
                  </div>
                </div>
              </form>
            </div>
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
      name: null,
      email: null,
      password: null,
      passwordConfirm: null,
      success: false,
      error: false,
      response: null
    }
  },
  methods: {
    register(event) {
      event.preventDefault()
      auth.register(this, this.name, this.email, this.password, this.passwordConfirm)
    }
  }
}
</script>
