<template>
    <div class="uk-flex uk-flex-middle uk-flex-center uk-height-viewport uk-background-muted">
      <div class="uk-width-medium uk-padding uk-card uk-card-default uk-card-body">
        <h3 class="uk-card-title">Register</h3>
        <form @submit.prevent="register">
          <div class="uk-margin">
            <label for="name" class="uk-form-label">Name</label>
            <input v-model="name" id="name" type="text" class="uk-input" required>
          </div>
          <div class="uk-margin">
            <label for="email" class="uk-form-label">Email</label>
            <input v-model="email" id="email" type="email" class="uk-input" required>
          </div>
          <div class="uk-margin">
            <label for="phone" class="uk-form-label">Phone</label>
            <input v-model="phone" id="phone" type="text" class="uk-input" required>
          </div>
          <div class="uk-margin">
            <label for="password" class="uk-form-label">Password</label>
            <input v-model="password" id="password" type="password" class="uk-input" required>
          </div>
          <div class="uk-margin">
            <label for="password_confirmation" class="uk-form-label">Confirm Password</label>
            <input v-model="password_confirmation" id="password_confirmation" type="password" class="uk-input" required>
          </div>
          <div class="uk-margin">
            <button type="submit" class="uk-button uk-button-primary uk-width-1-1">Register</button>
          </div>
        </form>
        <div v-if="error" class="uk-alert-danger" uk-alert>
          {{ error }}
        </div>
      </div>
    </div>
  </template>

  <script>
  import axios from 'axios';

  export default {
    data() {
      return {
        name: '',
        email: '',
        phone: '',
        password: '',
        password_confirmation: '',
        error: null,
      };
    },
    methods: {
      async register() {
        try {
          const response = await axios.post('http://127.0.0.1:8000/api/auth/register', {
            name: this.name,
            email: this.email,
            phone: this.phone,
            password: this.password,
            password_confirmation: this.password_confirmation,
          });

          localStorage.setItem('token', response.data.token);
          localStorage.setItem('user', JSON.stringify(response.data.user));
          this.$router.push('/dashboard');
        } catch (error) {
          this.error = error.response.data.message || 'Registration failed';
        }
      },
    },
  };
  </script>

  <style scoped>
  .uk-card {
    width: 400px;
    max-width: 90%;
  }
  </style>
