<script>
import axios from 'axios';
import apiClient from '../../../services/api-client';

export default {
  data() {
    return {
      email_phone: '',
      password: '',
      error: null,
    };
  },
  methods: {
    async login() {
      try {
        const response =  await apiClient.post('/auth/login', {
          email_phone: this.email_phone,
          password: this.password,
        });
        console.log(response)
        localStorage.setItem('token', response.data.data.token);
        localStorage.setItem('user', JSON.stringify(response.data.user));
        this.$router.push('/dashboard');
      } catch (error) {
        this.error = error.response.data.message || 'Login failed';
      }
    },
  },
};
</script>


<template>
    <div class="uk-flex uk-flex-middle uk-flex-center uk-height-viewport uk-background-muted">
      <div class="uk-width-medium uk-padding uk-card uk-card-default uk-card-body">
        <h3 class="uk-card-title">Login</h3>
        <form @submit.prevent="login">
          <div class="uk-margin">
            <label for="email_phone" class="uk-form-label">Email or Phone</label>
            <input v-model="email_phone" id="email_phone" type="text" class="uk-input" required>
          </div>
          <div class="uk-margin">
            <label for="password" class="uk-form-label">Password</label>
            <input v-model="password" id="password" type="password" class="uk-input" required>
          </div>
          <div class="uk-margin">
            <button type="submit" class="uk-button uk-button-primary uk-width-1-1">Login</button>
          </div>
        </form>
        <div v-if="error" class="uk-alert-danger" uk-alert>
          {{ error }}
        </div>
      </div>
    </div>
  </template>



  <style scoped>
  .uk-card {
    width: 400px;
    max-width: 90%;
  }
  </style>
