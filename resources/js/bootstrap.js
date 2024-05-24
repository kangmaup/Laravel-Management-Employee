import axios from 'axios';
import {createApp} from 'vue';

import app from '../vue/app.vue';

import router from '../vue/router/index';

createApp(app).use(router).mount('#app');
window.axios = axios;

// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
